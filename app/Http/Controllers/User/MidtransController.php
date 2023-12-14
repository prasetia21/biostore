<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Models\Guest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderShipping;
use App\Models\OrderGuest;
use App\Models\OrderItemGuest;
use App\Models\OrderShippingGuest;
use App\Mail\OrderMail;
use App\Notifications\OrderComplete;
use Gloudemans\Shoppingcart\Facades\Cart;
use Midtrans\Snap;
use Midtrans\Config;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Exception;

class MidtransController extends Controller
{
    private function getMidtransSnapUrl($params)
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        try {
            // Get Snap Payment Page URL
            $snapUrl = Snap::createTransaction($params)->redirect_url;

            // Redirect to Snap Payment Page
            return $snapUrl;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function MidtransOrder(Request $request)
    {



        if (Session::has('coupon')) {
            $total_amount = Session::get('coupon')['total_amount'];
        } else {
            $total_amount = round($request->total);
        }

        if (Auth::check()) {

            $order = Order::create([
                'user_id' => Auth::id(),
                'raja_province_id' => $request->province,
                'city_id' => $request->city,
                'address' => $request->address,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
                'currency' => 'Rp',
                'amount' => $total_amount,
                'invoice_no' => 'BIOSTR' . mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'pending',
            ]);
        } else {
            $guest = Guest::create([
                'address' => $request->address,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
            ]);

            $order = Order::create([
                'guest_id' => $guest->id,
                'raja_province_id' => $request->province,
                'city_id' => $request->city,
                'address' => $request->address,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
                'currency' => 'Rp',
                'amount' => $total_amount,
                'invoice_no' => 'BIOSTR' . mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'pending',
            ]);
        }

        $transactionDetail = [
            'order_id' => $order->id . '-' . Str::random(5),
            'gross_amount' => $total_amount,
        ];

        $customerDetail = [
            'first_name'   => $request->name,
            'email'        => $request->email,
            'address'      => $request->address,
            'postal_code'  => $request->post_code,
            'phone'        => $request->phone,
        ];

        $gopay = 'gopay';
        $bank_transfer = 'bank_transfer';
        $credit_card = 'credit_card';

        $bankDetail = [
            $gopay,
            $bank_transfer,
            $credit_card,
        ];

        // request snap url midtrans
        $midtransParams = [
            'transaction_details' => $transactionDetail,
            'enabled_payments' => $bankDetail,
            'customer_details' => $customerDetail,
        ];

        // generate snap url mitrans
        $midtransSnapUrl = $this->getMidtransSnapUrl($midtransParams);

        $order->update([
            'pay_url' => $midtransSnapUrl,
            'payment_type' => 'Transfer',
            'payment_method' => 'Midtrans',
            'transaction_id' => $transactionDetail['order_id'],
            'order_number' => $order->id . '-' . Str::random(5),
            'created_at' => Carbon::now(),
        ]);

        //dd($charge);


        // Start Send Email

        $invoice = Order::findOrFail($order->id);


        $idr = $total_amount;
        $idPrice = "Rp." . number_format($idr, 2, ".", ",");

        $data = [

            'invoice_no' => $invoice->invoice_no,
            'amount' => $idPrice,
            'name' => $invoice->name,
            'email' => $invoice->email,

        ];

        //dd($data);

        Mail::to($request->email)->send(new OrderMail($data));


        // End Send Email 


        $carts = Cart::content();
        foreach ($carts as $cart) {

            OrderItem::insert([
                'order_id' => $order->id,
                'product_id' => $cart->id,
                'vendor_id' => $cart->options->vendor,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'created_at' => Carbon::now(),

            ]);
        } // End Foreach

        OrderShipping::insert([
            'order_id' => $order->id,
            'shipping_price' => $request->shipping_price,
            'shipping_expedition' => $request->shipping_expedition,
            'shipping_service' => $request->shipping_service,
            'shipping_estimation' => $request->shipping_estimation,
            'weight' => $request->weight,
            'created_at' => Carbon::now(),
        ]);

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        toastr()->success('Pesanan Berhasil Dibuat!!!');

        $snapUrl = Order::where('id', $order->id)->get('pay_url');
        //dd($snapUrl[0]['pay_url']);

        Cart::destroy();

        return redirect($snapUrl[0]['pay_url']);
    } // End Method 

    public function CashOrder(Request $request)
    {
        if (Auth::check()) {

            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'];
            } else {
                $total_amount = round($request->total);
            }


            $order_id = Order::insertGetId([
                'user_id' => Auth::id(),
                'raja_province_id' => $request->province,
                'city_id' => $request->city,
                'address' => $request->address,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
                'payment_type' => 'Cash On Delivery',
                'payment_method' => 'Cash On Delivery',
                'currency' => 'Rp.',
                'amount' => $total_amount,
                'order_number' => 'COD' . '-' . mt_rand(10000000, 99999999),
                'transaction_id' => 'Trx' . '-' . Str::random(5),
                'invoice_no' => 'BIOSTR' . mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'pending',
                'created_at' => Carbon::now(),

            ]);



            // Start Send Email

            $invoice = Order::findOrFail($order_id);

            $data = [

                'invoice_no' => $invoice->invoice_no,
                'amount' => $total_amount,
                'name' => $invoice->name,
                'email' => $invoice->email,

            ];

            Mail::to($request->email)->send(new OrderMail($data));

            // End Send Email 



            $carts = Cart::content();
            foreach ($carts as $cart) {

                OrderItem::insert([
                    'order_id' => $order_id,
                    'product_id' => $cart->id,
                    'color' => $cart->options->color,
                    'size' => $cart->options->size,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'created_at' => Carbon::now(),

                ]);
            } // End Foreach

            OrderShipping::insert([
                'order_id' => $order_id,
                'shipping_price' => $request->shipping_price,
                'shipping_expedition' => $request->shipping_expedition,
                'shipping_service' => $request->shipping_service,
                'shipping_estimation' => $request->shipping_estimation,
                'weight' => $request->weight,
                'created_at' => Carbon::now(),
            ]);

            if (Session::has('coupon')) {
                Session::forget('coupon');
            }

            Cart::destroy();

            toastr()->success('Pesanan Berhasil Dibuat!!!');


            return redirect()->route('dashboard');
        } else {

            if (Session::has('coupon')) {
                $total_amount = Session::get('coupon')['total_amount'];
            } else {
                $total_amount = round($request->total);
            }

            $guest = Guest::create([
                'address' => $request->address,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'created_at' => Carbon::now(),
            ]);


            $order_id = Order::insertGetId([
                'guest_id' => $guest->id,
                'raja_province_id' => $request->province,
                'city_id' => $request->city,
                'address' => $request->address,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'post_code' => $request->post_code,
                'notes' => $request->notes,
                'payment_type' => 'Cash On Delivery',
                'payment_method' => 'Cash On Delivery',
                'currency' => 'Rp.',
                'amount' => $total_amount,
                'order_number' => 'COD' . '-' . mt_rand(10000000, 99999999),
                'transaction_id' => 'Trx' . '-' . Str::random(5),
                'invoice_no' => 'BIOSTR' . mt_rand(10000000, 99999999),
                'order_date' => Carbon::now()->format('d F Y'),
                'order_month' => Carbon::now()->format('F'),
                'order_year' => Carbon::now()->format('Y'),
                'status' => 'pending',
                'created_at' => Carbon::now(),

            ]);



            // Start Send Email

            $invoice = Order::findOrFail($order_id);

            $data = [

                'invoice_no' => $invoice->invoice_no,
                'amount' => $total_amount,
                'name' => $invoice->name,
                'email' => $invoice->email,

            ];

            Mail::to($request->email)->send(new OrderMail($data));

            // End Send Email 



            $carts = Cart::content();
            foreach ($carts as $cart) {

                OrderItem::insert([
                    'order_id' => $order_id,
                    'product_id' => $cart->id,
                    'color' => $cart->options->color,
                    'size' => $cart->options->size,
                    'qty' => $cart->qty,
                    'price' => $cart->price,
                    'created_at' => Carbon::now(),

                ]);
            } // End Foreach

            OrderShipping::insert([
                'order_id' => $order_id,
                'shipping_price' => $request->shipping_price,
                'shipping_expedition' => $request->shipping_expedition,
                'shipping_service' => $request->shipping_service,
                'shipping_estimation' => $request->shipping_estimation,
                'weight' => $request->weight,
                'created_at' => Carbon::now(),
            ]);

            if (Session::has('coupon')) {
                Session::forget('coupon');
            }

            Cart::destroy();

            toastr()->success('Pesanan Berhasil Dibuat!!!');

            $guestData = Guest::find($guest->id);


            return view('frontend.order.guest.order_details', compact('guestData'));
        }
    } // End Method 

    // public function midtransCallback(Request $request)
    // {
    //     $notif = new \Midtrans\Notification();

    //     $transaction_status = $notif->transaction_status;
    //     $fraud = $notif->fraud_status;

    //     $transaction_id = explode('-', $notif->order_id)[0];
    //     $userOrder = Order::find($transaction_id);

    //     if ($transaction_status == 'capture') {
    //         if ($fraud == 'challenge') {
    //             // TODO Set payment status in merchant's database to 'challenge'
    //             $userOrder->status = 'pending';
    //         } else if ($fraud == 'accept') {
    //             // TODO Set payment status in merchant's database to 'success'
    //             $userOrder->status = 'paid';
    //             $userOrder->confirmed_date = Carbon::now();
    //         }
    //     } else if ($transaction_status == 'cancel') {
    //         if ($fraud == 'challenge') {
    //             // TODO Set payment status in merchant's database to 'failure'
    //             $userOrder->status = 'failed';
    //         } else if ($fraud == 'accept') {
    //             // TODO Set payment status in merchant's database to 'failure'
    //             $userOrder->status = 'failed';
    //         }
    //     } else if ($transaction_status == 'deny') {
    //         // TODO Set payment status in merchant's database to 'failure'
    //         $userOrder->status = 'failed';
    //     } else if ($transaction_status == 'settlement') {
    //         // TODO set payment status in merchant's database to 'Settlement'
    //         $userOrder->status = 'paid';
    //         $userOrder->confirmed_date = Carbon::now();
    //     } else if ($transaction_status == 'pending') {
    //         // TODO set payment status in merchant's database to 'Pending'
    //         $userOrder->status = 'pending';
    //     } else if ($transaction_status == 'expire') {
    //         // TODO set payment status in merchant's database to 'expire'
    //         $userOrder->status = 'failed';
    //     }

    //     $userOrder->save();
    //     return response()->json([
    //         'status' => 'success',
    //         'message' => 'Payment success'
    //     ]);
    // }

    public function midtransHandler(Request $request)
    {

        // ambil data dari body yang dikirimkan mitrans
        $data = $request->all();

        // ambil data signature key dari midtrans
        $signatureKey = $data['signature_key'];

        // ambil data orderId, status, gross amount dari frontend
        $orderId = $data['order_id'];
        $statusCode = $data['status_code'];
        $grossAmount = $data['gross_amount'];

        // panggil server key midtrans dari env
        $serverKey = env('MIDTRANS_SERVER_KEY');

        // buat dan hash signature key dengan data-data dari frontend
        $mySignatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        // cek data transaksi
        $transactionStatus = $data['transaction_status'];
        $type = $data['payment_type'];
        $fraudStatus = $data['fraud_status'];

        // cek apakah signature key dari midtrans valid? 
        // cocokan signature key kita dengan midtrans apakah sama
        if ($signatureKey !== $mySignatureKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'invalid signature'
            ], 400);
        }

        // cek apakah ada order id di database
        // pisahkan string order id, misal 9-abcde, yang akan diambil abcde
        $realOrderId = $orderId;

        // cari data order id, ambil $realOrderId dari array pertama 
        $order = Order::find($realOrderId);

        // cek apakah ditemukan order id
        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'order id not found'
            ], 404);
        }

        // pengecekan kedua, jika ketemu order id kemudian cek status ordernya
        // jika status order sudah berhasil maka webhook tidak diperlukan
        if ($order->status === 'success') {
            return response()->json([
                'status' => 'error',
                'message' => 'operation not permitted'
            ], 405);
        }

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                // TODO Set payment status in merchant's database to 'challenge'
                $order->status = 'pending';
            } else if ($fraudStatus == 'accept') {
                // TODO Set payment status in merchant's database to 'success'
                $order->status = 'paid';
                $order->payment_type = $type;
                $order->confirmed_date = Carbon::now();
                $order->processing_date = Carbon::now();
            }
        } else if ($transactionStatus == 'cancel') {
            if ($fraudStatus == 'challenge') {
                // TODO Set payment status in merchant's database to 'failure'
                $order->status = 'failed';
            } else if ($fraudStatus == 'accept') {
                // TODO Set payment status in merchant's database to 'failure'
                $order->status = 'failed';
            }
        } else if ($transactionStatus == 'deny') {
            // TODO Set payment status in merchant's database to 'failure'
            $order->status = 'failed';
        } else if ($transactionStatus == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $order->status = 'paid';
            $order->payment_type = $type;
            $order->confirmed_date = Carbon::now();
            $order->processing_date = Carbon::now();
        } else if ($transactionStatus == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            $order->status = 'pending';
        } else if ($transactionStatus == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $order->status = 'failed';
        }

        $order->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Payment success'
        ]);
    }
}
