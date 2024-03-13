<?php

namespace App\Http\Controllers\Guest\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Guest;
use App\Models\OrderNinja;
use App\Models\Regency;
use Carbon\Carbon;
use App\Mail\OrderMail;
use App\Models\OrderItem;
use App\Models\TokenNinja;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

class CheckoutGuestController extends Controller
{
    public function DistrictGetAjax($province_id)
    {

        $ship = District::where('province_id', $province_id)->orderBy('name', 'ASC')->get();
        return json_encode($ship);
    } // End Method 

    public function CityGetAjax($district_id)
    {

        $ship = Regency::where('district_id', $district_id)->orderBy('name', 'ASC')->get();
        return json_encode($ship);
    } // End Method 

    private function isHoliday($date)
    {
        $holidays = [
            '2024-01-01', // Tahun Baru 2024 Masehi,
            '2024-02-08', // Isra Mi'raj Nabi Muhammad SAW
            '2024-02-10', // Tahun Baru Imlek 2575 Kongzili
            '2024-03-11', // Hari Suci Nyepi Tahun Baru Saka 1946
            '2024-03-29', // Wafat Isa Almasih
            '2024-03-31', // Hari Paskah
            '2024-04-10', // Idul Fitri 1445 Hijriah
            '2024-04-11', // Idul Fitri 1445 Hijriah (Cuti Bersama)
            '2024-05-01', // Hari Buruh Internasional
            '2024-05-09', // Kenaikan Isa Almasih
            '2024-05-23', // Hari Raya Waisak 2568 BE
            '2024-06-01', // Hari Lahir Pancasila
            '2024-06-17', // Hari Raya Idul Adha 1445 Hijriah
            '2024-07-07', // Tahun Baru Islam 1446 Hijriah
            '2024-08-17', // Hari Kemerdekaan Republik Indonesia
            '2024-09-16', // Maulid Nabi Muhammad SAW (Cuti Bersama)

        ];

        return in_array($date->format('Y-m-d'), $holidays);
    }

    public function getHariPickup()
    {
        $besok = Carbon::tomorrow();


        if ($besok->isSunday() || $this->isHoliday($besok)) {

            $besok = $besok->addDay();
        }

        return $besok->format('Y-m-d');
    }


    public function createCheckout(Request $request)
    {
        $validatedData = [
            'shipping_name' => 'required|string',
            'shipping_phone' => 'required|string',
            'shipping_email' => 'required|email',
            'shipping_address1' => 'required|string',
            'kecamatan_destination' => 'required|string',
            'city_destination' => 'required|string',
            'province_destination' => 'required|string',
            'post_code' => 'required|string',
            'note' => 'nullable|string',
            'grand_total_price' => 'required|integer',
            'delivery_start_date' => 'required',
            'pickup_date' => 'required',
            'weight' => 'required|integer',
            'quantity' => 'required|integer',
        ];



        // ambil data dari body
        $data = $request->all();


        // cek validasi data, import terlebih dahulu Validator, use Illuminate\Support\Facades\Validator;
        $validator = Validator::make($data, $validatedData);

        // cek apakah ada error di validasi data
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $ninja_province_id = $request->province_destination;
        $ninja_regency_id = $request->city_destination;
        $ninja_district_id = $request->kecamatan_destination;
        $service_type = "Parcel";
        $service_level = "Standard";
        $requested_tracking_number = 'BTV-' . mt_rand(100000, 999999);
        $merchant_order_number = 'BIOFAST-' . mt_rand(10000000, 99999999);

        $origin_name = "Bio Official";
        $origin_email = "bioofficial@ninjasandbox.co";
        $origin_phone = "082243380001";
        $shipping_origin1 = "JL. BABARAN BARAT GG. VIII UH III 817";
        $shipping_origin2 = "Jl. Celeban, BARU, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta";
        $kecamatan_origin = "Umbulharjo";
        $city_origin = "Kota Yogyakarta";
        $province_origin = "DI Yogyakarta";
        $address_type_origin = "office";
        $country_origin = "ID";
        $post_code_origin = 55167;


        $shipping_name = $request->shipping_name;
        $shipping_email = $request->shipping_email;
        $shipping_phone = $request->shipping_phone;
        $shipping_address1 = $request->shipping_address1;
        $shipping_address2 = "";
        $kecamatan_destination = $request->to_kecamatan_kirim;
        $city_destination = $request->to_kota_kirim;
        $province_destination = $request->to_provinsi_kirim;
        $address_type_destination = "home";
        $country_destination = "ID";
        $post_code_destination = $request->post_code;


        $notes = $request->notes;
        $weight = $request->weight;
        $shipping_price = $request->shipping_price;
        $cash_on_delivery = $request->grand_total_price;
        $cash_on_delivery_currency = "IDR";

        $pickup_date = $this->getHariPickup();

        $formatdate = 'Y-m-d';
        $delivery_start_date = Carbon::parse($pickup_date)->addDay()->format($formatdate);


        $pickup_start_time = "12:00";
        $pickup_end_time = "15:00";
        $deliver_start_time = "09:00";
        $deliver_end_time = "18:00";

        $is_dangerous_good = false;
        $confirmed_date = Carbon::now();
        $is_pickup_required = true;
        $pickup_address_id = "";
        $pickup_service_type = "Scheduled";
        $pickup_service_level = "Standard";
        $pickup_instructions = "Pickup with care!";
        $delivery_instructions = "COD(Cash on Delivery)";
        $item_description = "Cat Kayu Biovarnish";
        $quantity = $request->quantity;
        $timezone = "Asia/Jakarta";


        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round($cash_on_delivery);
        }

        $guest = Guest::create([
            'address' => $shipping_address1,
            'name' => $shipping_name,
            'email' => $shipping_email,
            'phone' => $shipping_phone,
            'post_code' => $post_code_destination,
        ]);


        $order = OrderNinja::create([
            'guest_id' => $guest->id,
            'ninja_province_id' => $ninja_province_id,
            'ninja_regency_id' => $ninja_regency_id,
            'ninja_district_id' => $ninja_district_id,
            'service_type' => $service_type,
            'service_level' => $service_level,
            'payment_type' => 'Cash On Delivery',
            'requested_tracking_number' => $requested_tracking_number,
            'merchant_order_number' => $merchant_order_number,
            'origin_name' => $origin_name,
            'origin_email' => $origin_email,
            'origin_phone' => $origin_phone,
            'shipping_origin1' => $shipping_origin1,
            'shipping_origin2' => $shipping_origin2,
            'kecamatan_origin' => $kecamatan_origin,
            'city_origin' => $city_origin,
            'province_origin' => $province_origin,
            'address_type_origin' => $address_type_origin,
            'country_origin' => $country_origin,
            'post_code_origin' => $post_code_origin,
            'shipping_name' => $shipping_name,
            'shipping_email' => $shipping_email,
            'shipping_phone' => $shipping_phone,
            'shipping_address1' => $shipping_address1,
            'shipping_address2' => $shipping_address2,
            'kecamatan_destination' => $kecamatan_destination,
            'city_destination' => $city_destination,
            'province_destination' => $province_destination,
            'address_type_destination' => $address_type_destination,
            'country_destination' => $country_destination,
            'post_code_destination' => $post_code_destination,
            'notes' => $notes,
            'weight' => $weight,
            'currency' => $cash_on_delivery_currency,
            'shipping_price' => $shipping_price,
            'amount' => $total_amount,
            'cash_on_delivery' => $cash_on_delivery,
            'confirmed_date' => $confirmed_date,
            'processing_date' => $pickup_date,
            'pickup_date' => $pickup_date,
            'pickup_start_time' => $pickup_start_time,
            'pickup_end_time' => $pickup_end_time,
            'delivery_start_date' => $delivery_start_date,
            'deliver_start_time' => $deliver_start_time,
            'deliver_end_time' => $deliver_end_time,
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'confirm',
        ]);

        $invoice = OrderNinja::findOrFail($order->id);
        $data = [
            'invoice_no' => $invoice->requested_tracking_number,
            'amount' => $total_amount,
            'name' => $invoice->shipping_name,
            'email' => $invoice->shipping_email,
        ];

        // Mail::to($shipping_email)->send(new OrderMail($data));
        // Mail::to($origin_email)->send(new OrderMail($data));

        $carts = Cart::content();

        foreach ($carts as $cart) {

            OrderItem::insert([
                'order_ninja_id' => $order->id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,

            ]);
        } // End Foreach

        $data = [
            'service_type' => $service_type,
            'service_level' => $service_level,
            'requested_tracking_number' => $requested_tracking_number,
            'reference' => [
                'merchant_order_number' => $merchant_order_number
            ],
            'from' => [
                'name' => $origin_name,
                'phone_number' => $origin_phone,
                'email' => $origin_email,
                'address' => [
                    'address1' => $shipping_origin1,
                    'address2' => $shipping_origin2,
                    'kecamatan' => $kecamatan_origin,
                    'city' => $city_origin,
                    'province' => $province_origin,
                    'address_type' => $address_type_origin,
                    'country' => $country_origin,
                    'postcode' => $post_code_origin
                ]
            ],
            'to' => [
                'name' => $shipping_name,
                'phone_number' => $shipping_phone,
                'email' => $shipping_email,
                'address' => [
                    'address1' => $shipping_address1,
                    'address2' => $shipping_address2,
                    'kecamatan' => $kecamatan_destination,
                    'city' => $city_destination,
                    'province' => $province_destination,
                    'address_type' => $address_type_destination,
                    'country' => $country_destination,
                    'postcode' => $post_code_destination
                ]
            ],
            'parcel_job' => [
                'is_pickup_required' => $is_pickup_required,
                'pickup_address_id' => $pickup_address_id,
                'pickup_service_type' => $pickup_service_type,
                'pickup_service_level' => $pickup_service_level,
                'cash_on_delivery' => (int) $cash_on_delivery,
                'cash_on_delivery_currency' => $cash_on_delivery_currency,
                'pickup_date' => $pickup_date,
                'pickup_timeslot' => [
                    'start_time' => $pickup_start_time,
                    'end_time' => $pickup_end_time,
                    'timezone' => $timezone
                ],
                'pickup_instructions' => $pickup_instructions,
                'delivery_instructions' => $delivery_instructions,
                'delivery_start_date' => $delivery_start_date,
                'delivery_timeslot' => [
                    'start_time' => $deliver_start_time,
                    'end_time' => $deliver_end_time,
                    'timezone' => $timezone
                ],
                'dimensions' => [
                    'weight' => floatval($weight)
                ],
                'items' => [
                    [
                        'item_description' => $item_description,
                        'quantity' => (int) $quantity,
                        'is_dangerous_good' => $is_dangerous_good,
                    ],
                ],
            ],
        ];


        try {
            $client = new Client();


            // Ubah data menjadi JSON
            $payload = $data;
            $token = $request->token;

            $maxRetries = 3;
            $retryCount = 0;

            do {
                // Send request to third-party API with authorization header
                $client = new Client();
                $response = $client->post('https://api-sandbox.ninjavan.co/sg/4.2/orders', [
                    'json' => $payload,
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token->access_token,
                    ],
                ]);

                $retryCount++;


                if ($response->getStatusCode() == 200) {
                    $responseBody = json_decode($response->getBody(), true);

                    $data = $responseBody;
            
                    // Extract the tracking number
                    $tid = $data['tracking_number'];


                    OrderNinja::where('id', $order->id)->update([
                        'tracking_number' => $tid,
                    ]);

                    return response()->json([
                        'message' => 'Request successful!',
                        'data' => $responseBody,
                    ]);
                } else {
                    // Retry logic
                    if ($retryCount < $maxRetries) {
                        continue;
                    } else {
                        // Error
                        return response()->json([
                            'success' => false,
                            'message' => 'Failed to create order and send to third-party API. Error: ' . $response->getStatusCode(),
                        ], 500);
                    }
                }
            } while ($retryCount < $maxRetries);
        } catch (Exception $e) {
            // Handle validation errors or other exceptions
            return response()->json([
                'message' => 'An error occurred while sending the request.',
                'error' => $e->getMessage(),
            ], 500);
        }


        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        Cart::destroy();

        toastr()->success('Pesanan Berhasil Dibuat!!!');

        return redirect()->route('home.guest');
    }

    function formatPhoneNumber($number)
    {
        // Remove leading zero (if any)
        $number = ltrim($number, '0');

        // Prepend country code (+62 for Indonesia)
        $formattedNumber = '+62' . $number;

        return $formattedNumber;
    }


      // public function CheckoutStore(Request $request)
    // {
    //     $data = array();

    //     $data['ninja_province_id'] = $request->province_destination;
    //     $data['ninja_regency_id'] = $request->city_destination;
    //     $data['ninja_district_id'] = $request->kecamatan_destination;
    //     $data['service_type'] = "Parcel";
    //     $data['service_level'] = "Standard";


    //     $data['origin_name'] = "Bio Official";
    //     $data['origin_email'] = "bioofficial@ninjasandbox.co";
    //     $data['origin_phone'] = "082243380001";
    //     $data['shipping_origin1'] = "JL. BABARAN BARAT GG. VIII UH III 817, Jl. Celeban, BARU, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta";
    //     $data['shipping_origin2'] = "";
    //     $data['kecamatan_origin'] = "Umbulharjo";
    //     $data['city_origin'] = "Kota Yogyakarta";
    //     $data['province_origin'] = "DI Yogyakarta";
    //     $data['address_type_origin'] = "office";
    //     $data['country_origin'] = "ID";
    //     $data['post_code_origin'] = 55167;


    //     $data['shipping_name'] = $request->shipping_name;
    //     $data['shipping_email'] = $request->shipping_email;
    //     $data['shipping_phone'] = $request->shipping_phone;
    //     $data['shipping_address1'] = $request->shipping_address;
    //     $data['shipping_address2'] = "";
    //     $data['kecamatan_destination'] = $request->to_kecamatan_kirim;
    //     $data['city_destination'] = $request->to_kota_kirim;
    //     $data['province_destination'] = $request->to_provinsi_kirim;
    //     $data['address_type_destination'] = "home";
    //     $data['country_destination'] = "ID";
    //     $data['post_code_destination'] = $request->post_code;


    //     $data['notes'] = $request->notes;
    //     $data['weight'] = $request->weight;
    //     $data['shipping_price'] = $request->shipping_price;
    //     $data['total'] = $request->grand_total_price;

    //     // dd($data);
    //     //$cartTotal = Cart::total();

    //     if ($request->payment_option == 'midtrans') {
    //         return view('frontend.payment.guest.midtrans', compact('data'));
    //     } else {
    //         return view('frontend.payment.guest.cash', compact('data'));
    //     }
    // } // End Method 

    // public function CheckoutNinja(Request $request)
    // {
    //     $carts = Cart::content();

    //     dd(Cart::content());

    //     $ninja_province_id = $request->province_destination;
    //     $ninja_regency_id = $request->city_destination;
    //     $ninja_district_id = $request->kecamatan_destination;
    //     $service_type = "Parcel";
    //     $service_level = "Standard";
    //     $requested_tracking_number = 'BT' . mt_rand(100000, 999999);
    //     $merchant_order_number = 'BIOFAST' . mt_rand(10000000, 99999999);

    //     $origin_name = "Bio Official";
    //     $origin_email = "bioofficial@ninjasandbox.co";
    //     $origin_phone = "082243380001";
    //     $shipping_origin1 = "JL. BABARAN BARAT GG. VIII UH III 817, Jl. Celeban, BARU, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta";
    //     $shipping_origin2 = "";
    //     $kecamatan_origin = "Umbulharjo";
    //     $city_origin = "Kota Yogyakarta";
    //     $province_origin = "DI Yogyakarta";
    //     $address_type_origin = "office";
    //     $country_origin = "ID";
    //     $post_code_origin = 55167;


    //     $shipping_name = $request->shipping_name;
    //     $shipping_email = $request->shipping_email;
    //     $shipping_phone = $request->shipping_phone;
    //     $shipping_address1 = $request->shipping_address;
    //     $shipping_address2 = "";
    //     $kecamatan_destination = $request->to_kecamatan_kirim;
    //     $city_destination = $request->to_kota_kirim;
    //     $province_destination = $request->to_provinsi_kirim;
    //     $address_type_destination = "home";
    //     $country_destination = "ID";
    //     $post_code_destination = $request->post_code;


    //     $notes = $request->notes;
    //     $weight = $request->weight;
    //     $shipping_price = $request->shipping_price;
    //     $cash_on_delivery = $request->grand_total_price;
    //     $currency = "IDR";

    //     $pickup_date = $this->getHariPickup();

    //     $formatdate = 'Y-m-d';
    //     $delivery_start_date = Carbon::parse($pickup_date)->addDay()->format($formatdate);


    //     $start_time = "10:00";
    //     $end_time = "12:00";

    //     $data = $request->all();


    //     if (Session::has('coupon')) {
    //         $total_amount = Session::get('coupon')['total_amount'];
    //     } else {
    //         $total_amount = round($request->grand_total_price);
    //     }

    //     $guest = Guest::create([
    //         'address' => $request->shipping_address1,
    //         'name' => $request->shipping_name,
    //         'email' => $request->shipping_email,
    //         'phone' => $request->shipping_phone,
    //         'post_code' => $request->post_code,
    //     ]);



    //     $order = OrderNinja::create([
    //         'guest_id' => $guest->id,
    //         'ninja_province_id' => $ninja_province_id,
    //         'ninja_regency_id' => $ninja_regency_id,
    //         'ninja_district_id' => $ninja_district_id,
    //         'service_type' => $service_type,
    //         'service_level' => $service_level,
    //         'payment_type' => 'Cash On Delivery',
    //         'requested_tracking_number' => $requested_tracking_number,
    //         'merchant_order_number' => $merchant_order_number,
    //         'origin_name' => $origin_name,
    //         'origin_email' => $origin_email,
    //         'origin_phone' => $origin_phone,
    //         'shipping_origin1' => $shipping_origin1,
    //         'shipping_origin2' => $shipping_origin2,
    //         'kecamatan_origin' => $kecamatan_origin,
    //         'city_origin' => $city_origin,
    //         'province_origin' => $province_origin,
    //         'address_type_origin' => $address_type_origin,
    //         'country_origin' => $country_origin,
    //         'post_code_origin' => $post_code_origin,
    //         'shipping_name' => $shipping_name,
    //         'shipping_email' => $shipping_email,
    //         'shipping_phone' => $shipping_phone,
    //         'shipping_address1' => $shipping_address1,
    //         'shipping_address2' => $shipping_address2,
    //         'kecamatan_destination' => $kecamatan_destination,
    //         'city_destination' => $city_destination,
    //         'province_destination' => $province_destination,
    //         'address_type_destination' => $address_type_destination,
    //         'country_destination' => $country_destination,
    //         'post_code_destination' => $post_code_destination,
    //         'notes' => $notes,
    //         'weight' => $weight,
    //         'currency' => $currency,
    //         'shipping_price' => $shipping_price,
    //         'amount' => $total_amount,
    //         'cash_on_delivery' => $cash_on_delivery,
    //         'order_date' => Carbon::now()->format('d F Y'),
    //         'order_month' => Carbon::now()->format('F'),
    //         'order_year' => Carbon::now()->format('Y'),
    //         'status' => 'pending',
    //     ]);

    //     $carts = Cart::content();
    //     foreach ($carts as $cart) {

    //         OrderItem::insert([
    //             'order_ninja_id' => $order->id,
    //             'product_id' => $cart->id,
    //             'color' => $cart->options->color,
    //             'size' => $cart->options->size,
    //             'qty' => $cart->qty,
    //             'price' => $cart->price,

    //         ]);
    //     } // End Foreach

    //     $item_description = $cart->name;
    //     $quantity = $cart->qty;

    //     $payload = [
    //         'service_type' => $service_type,
    //         'service_level' => $service_level,
    //         'requested_tracking_number' => $requested_tracking_number,
    //         'reference' => [
    //             'merchant_order_number' => $merchant_order_number,
    //         ],
    //         'from' => [
    //             'name' => $origin_name,
    //             'phone_number' => $origin_phone,
    //             'email' => $origin_email,
    //             'address' => [
    //                 'address1' => $shipping_origin1,
    //                 'address2' => $shipping_origin2,
    //                 'kecamatan' => $kecamatan_origin,
    //                 'city' => $city_origin,
    //                 'province' => $province_origin,
    //                 'address_type' => $address_type_origin,
    //                 'country' => $country_origin,
    //                 'postcode' => $post_code_origin,
    //             ]
    //         ],
    //         'to' => [
    //             'name' => $shipping_name,
    //             'phone_number' => $shipping_phone,
    //             'email' => $shipping_email,
    //             'address' => [
    //                 'address1' => $shipping_address1,
    //                 'address2' => $shipping_address2,
    //                 'kecamatan' => $kecamatan_destination,
    //                 'city' => $city_destination,
    //                 'province' => $province_destination,
    //                 'address_type' => $address_type_destination,
    //                 'country' => $country_destination,
    //                 'postcode' => $post_code_destination,
    //             ]
    //         ],
    //         'parcel_job' => [
    //             'is_pickup_required' => true,
    //             'pickup_address_id' => '',
    //             'pickup_service_type' => 'Scheduled',
    //             'pickup_service_level' => 'Standard',
    //             'cash_on_delivery' => $cash_on_delivery,
    //             'cash_on_delivery_currency' => $currency,
    //             'pickup_date' => $pickup_date,
    //             'pickup_address' => [
    //                 'name' => $origin_name,
    //                 'phone_number' => $origin_phone,
    //                 'email' => $origin_email,
    //                 'address' => [
    //                     'address1' => $shipping_origin1,
    //                     'address2' => $shipping_origin2,
    //                     'kecamatan' => $kecamatan_origin,
    //                     'city' => $city_origin,
    //                     'province' => $province_origin,
    //                     'address_type' => $address_type_origin,
    //                     'country' => $country_origin,
    //                     'postcode' => $post_code_origin
    //                 ]
    //             ],
    //             'pickup_timeslot' => [
    //                 'start_time' => $start_time,
    //                 'end_time' => $end_time,
    //                 'timezone' => 'Asia/Jakarta'
    //             ],
    //             'pickup_instructions' => 'Pickup with care!',
    //             'delivery_instructions' => 'COD (Cash on Delivery)',
    //             'delivery_start_date' => $delivery_start_date,
    //             'delivery_timeslot' => [
    //                 'start_time' => $start_time,
    //                 'end_time' => $end_time,
    //                 'timezone' => 'Asia/Jakarta'
    //             ],
    //             'dimensions' => [
    //                 'weight' => $weight
    //             ],
    //             'items' => [
    //                 [
    //                     'item_description' => $item_description,
    //                     'quantity' => $quantity,
    //                     'is_dangerous_good' => false
    //                 ]
    //             ]
    //         ]
    //     ];

    //     $accessToken = TokenNinja::firstOrFail();

    //     // Retry logic
    //     $maxRetries = 3;
    //     $retryCount = 0;

    //     do {
    //         // Send request to third-party API with authorization header
    //         $client = new Client();
    //         $response = $client->post('https://api-sandbox.ninjavan.co/sg/4.2/orders', [
    //             'json' => $payload,
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $accessToken->access_token,
    //             ],
    //         ]);

    //         $retryCount++;

    //         // Handle third-party API response
    //         if ($response->getStatusCode() == 200) {
    //             $thirdPartyResponse = json_decode($response->getBody(), true);

    //             // Process successful response (e.g., update order status, etc.)
    //             if (isset($thirdPartyResponse['success']) && $thirdPartyResponse['success']) {
    //                 // Success
    //                 return response()->json([
    //                     'success' => true,
    //                     'message' => 'Order created and sent to third-party API successfully!',
    //                     'data' => $order, // (if you create an order model)
    //                 ]);
    //             } else {
    //                 // Third-party API success, but internal processing failed
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Order created, but failed to process third-party API response: ' . $thirdPartyResponse['message'],
    //                 ], 500);
    //             }
    //         } else {
    //             // Retry logic
    //             if ($retryCount < $maxRetries) {
    //                 continue;
    //             } else {
    //                 // Error
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Failed to create order and send to third-party API. Error: ' . $response->getStatusCode(),
    //                 ], 500);
    //             }
    //         }
    //     } while ($retryCount < $maxRetries);

    //     // Start Send Email

    //     try {
    //         $invoice = OrderNinja::findOrFail($order->id);
    //         $data = [
    //             'invoice_no' => $invoice->requested_tracking_number,
    //             'amount' => $total_amount,
    //             'name' => $invoice->shipping_name,
    //             'email' => $invoice->shipping_email,
    //         ];
    //         Mail::to($request->shipping_email)->send(new OrderMail($data));
    //     } catch (Exception $e) {
    //         // Tangani error pengiriman email
    //         return response()->json([
    //             'success' => true, // Pembuatan order berhasil
    //             'message' => 'Order berhasil dibuat. Notifikasi email tidak dapat terkirim.',
    //         ]);
    //     }

    //     if (Session::has('coupon')) {
    //         Session::forget('coupon');
    //     }

    //     Cart::destroy();

    //     toastr()->success('Pesanan Berhasil Dibuat!!!');

    //     return redirect()->route('home.guest');
    // } // End Method 

    // protected function kirimNinjaOrder(array $payload, string $token)
    // {

    //     //dd($payload);
    //     $maxRetries = 3;
    //     $retryCount = 0;

    //     do {
    //         // Send request to third-party API with authorization header
    //         $client = new Client();
    //         $response = $client->post('https://api-sandbox.ninjavan.co/sg/4.2/orders', [
    //             'json' => $payload,
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $token,
    //             ],
    //         ]);

    //         $retryCount++;

    //         // Handle third-party API response
    //         if ($response->getStatusCode() == 200) {
    //             $thirdPartyResponse = json_decode($response->getBody(), true);

    //             // Process successful response (e.g., update order status, etc.)
    //             if (isset($thirdPartyResponse['success']) && $thirdPartyResponse['success']) {
    //                 // Success
    //                 return response()->json([
    //                     'success' => true,
    //                     'message' => 'Order created and sent to third-party API successfully!',
    //                     'data' => $payload, // (if you create an order model)
    //                 ]);
    //             } else {
    //                 // Third-party API success, but internal processing failed
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Order created, but failed to process third-party API response: ' . $thirdPartyResponse['message'],
    //                 ], 500);
    //             }
    //         } else {
    //             // Retry logic
    //             if ($retryCount < $maxRetries) {
    //                 continue;
    //             } else {
    //                 // Error
    //                 return response()->json([
    //                     'success' => false,
    //                     'message' => 'Failed to create order and send to third-party API. Error: ' . $response->getStatusCode(),
    //                 ], 500);
    //             }
    //         }
    //     } while ($retryCount < $maxRetries);
    // }
}
