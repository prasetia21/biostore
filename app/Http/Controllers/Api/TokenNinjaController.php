<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TokenNinja;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TokenNinjaController extends Controller
{
    public function generateAccessToken(Request $request)
    {
        $countryCode = env('COUNTRY_CODE');
        $clientId = env('NINJA_CLIENT_ID');
        $clientSecret = env('NINJA_CLIENT_SECRET');

        $client = new Client();

        $token = $this->getAccessToken();

        $expiresAt = $this->getAccessTokenExpiration($token->access_token);
        $bufferTime = 5 * 60; // 5 minutes in seconds

        $expire = strtotime($expiresAt);
        $currentTime = time();

        $timeDiff = $expire - $currentTime;


        if ($timeDiff <= $bufferTime) {

            try {
                $body = [
                    'grant_type' => 'client_credentials',
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                ];

                $response = $client->post('https://api-sandbox.ninjavan.co/' . $countryCode . '/2.0/oauth/access_token', [
                    'form_params' => $body,
                ]);

                return response()->json($response->getBody()->getContents());
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                if ($e->getResponse()->getStatusCode() === 401) {

                    $newToken = $this->generateNewAccessToken($client, $countryCode, $clientId, $clientSecret);

                    TokenNinja::where('id', 1)->update([
                        'access_token' => $newToken['access_token'],
                        'expires' => date('Y-m-d H:i:s', $newToken['expires']),
                        'expires_in' => $newToken['expires_in'],
                        'token_type' => $newToken['token_type'],

                    ]);

                    $token = TokenNinja::where('id', 1)->first();

                    return response()->json([
                        'success' => true,
                        'token' => $token,
                    ]);
                }

                throw $e;
            }

            $newToken = $this->generateNewAccessToken($client, $countryCode, $clientId, $clientSecret);

            TokenNinja::where('id', 1)->update([
                'access_token' => $newToken['access_token'],
                'expires' => date('Y-m-d H:i:s', $newToken['expires']),
                'expires_in' => $newToken['expires_in'],
                'token_type' => $newToken['token_type'],

            ]);

            return response()->json([
                'success' => true,
                'token' => $newToken,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Access token masih aktif.',
            ], 401);
        }
    }

    private function getAccessToken()
    {
        $countryCode = env('COUNTRY_CODE');

        $clientId = env('NINJA_CLIENT_ID');
        $clientSecret = env('NINJA_CLIENT_SECRET');

        $client = new Client();

        $accessToken = TokenNinja::first();



        if ($accessToken === null) {
            $accessToken = $this->generateNewAccessToken($client, $countryCode, $clientId, $clientSecret);

            $accessToken = TokenNinja::create([
                'id' => 1,
                'access_token' => $accessToken['access_token'],
                'expires' => date('Y-m-d H:i:s', $accessToken['expires']),
                'expires_in' => $accessToken['expires_in'],
                'token_type' => 'bearer',
            ]);
        }

        return $accessToken;
    }

    private function getAccessTokenExpiration($token)
    {
        $accessToken = TokenNinja::where('access_token', $token)->first();

        if (!$accessToken) {
            if (empty($token)) {
                return null;
            } else {
                throw new Exception('Access token not found.');
            }
        }

        return $accessToken->expires;
    }

    private function generateNewAccessToken($client, $countryCode, $clientId, $clientSecret)
    {
        $body = [
            'grant_type' => 'client_credentials',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ];

        $response = $client->post('https://api-sandbox.ninjavan.co/' . $countryCode . '/2.0/oauth/access_token', [
            'form_params' => $body,
        ]);

        $data = json_decode((string) $response->getBody(), true);
        return $data;
    }

    private function revokeAccessToken($token)
    {
        $accessToken = TokenNinja::where('access_token', $token->access_token)->first();

        if ($accessToken) {
            $accessToken->delete();
        }
    }

    public function ninja_tarif(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'weight' => 'required|numeric',
                'service_level' => 'required|string|in:Standard,Express,Sameday,Nextday',
                'l1_tier_code' => 'required|string',
                'l2_tier_code' => 'required|string',
                'tol1_tier_code' => 'required|string',
                'tol2_tier_code' => 'required|string',
            ]);

            $weight = $validatedData['weight'];
            $service_level = $validatedData['service_level'];
            $l1_tier_code = $validatedData['l1_tier_code'];
            $l2_tier_code = $validatedData['l2_tier_code'];
            $tol1_tier_code = $validatedData['tol1_tier_code'];
            $tol2_tier_code = $validatedData['tol2_tier_code'];

            $data = [
                'weight' => floatval($weight),
                'service_level' => $service_level,
                'from' => [
                    'l1_tier_code' => $l1_tier_code,
                    'l2_tier_code' => $l2_tier_code,
                ],
                'to' => [
                    'l1_tier_code' => $tol1_tier_code,
                    'l2_tier_code' => $tol2_tier_code,
                ],
            ];

            // Ubah data menjadi JSON
            $payload = $data;

            // Build the API URL (replace with your actual URL)
            $apiUrl = env('NINJA_TARIFF_ENDPOINT');


            // Create a Guzzle client with appropriate headers (replace if needed)
            $client = new Client([
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    // Add any required authentication headers here
                ],
            ]);

            
            // Send the POST request
            $response = $client->post($apiUrl, [
                'json' => $payload,
            ]);

            // Check for successful response
            if ($response->getStatusCode() === 200) {
                $responseBody = $response->getBody()->getContents();
                // Handle successful response here, e.g., return JSON data to frontend
                return response()->json([
                    'message' => 'Request successful!',
                    'data' => json_decode($responseBody),
                ]);
            } else {
                // Handle API errors
                throw new Exception("API error: " . $response->getStatusCode() . " - " . $response->getBody()->getContents());
            }
        } catch (Exception $e) {
            // Handle validation errors or other exceptions
            return response()->json([
                'message' => 'Error: ' . $e->getMessage(),
            ], 400);
        }
    }

    public function ninja_order_tes(Request $request)
    {

        $validatedData = $request->validate([
            'service_level' => 'required|string',
            'service_type' => 'required|string',
            'requested_tracking_number' => 'required|string',
            'merchant_order_number' => 'required|string',
            'origin_name' => 'required|string',
            'origin_phone' => 'required|string',
            'origin_email' => 'required|email',
            'shipping_origin1' => 'required|string',
            'shipping_origin2' => 'nullable|string',
            'kecamatan_origin' => 'required|string',
            'city_origin' => 'required|string',
            'province_origin' => 'required|string',
            'address_type_origin' => 'required|string',
            'country_origin' => 'required|string',
            'post_code_origin' => 'required|string',
            'shipping_name' => 'required|string',
            'shipping_phone' => 'required|string',
            'shipping_email' => 'required|email',
            'shipping_address1' => 'required|string',
            'shipping_address2' => 'nullable|string',
            'kecamatan_destination' => 'required|string',
            'city_destination' => 'required|string',
            'province_destination' => 'required|string',
            'address_type_destination' => 'required|string',
            'country_destination' => 'required|string',
            'post_code_destination' => 'required|string',
            'note' => 'nullable|string',
            'is_pickup_required' => 'required',
            'pickup_address_id' => 'nullable',
            'pickup_service_type' => 'required|string',
            'pickup_service_level' => 'required|string',
            'cash_on_delivery' => 'required|integer',
            'cash_on_delivery_currency' => 'required|string',
            'pickup_instructions' => 'required|string',
            'delivery_instructions' => 'required|string',
            'delivery_start_date' => 'required',
            'pickup_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'timezone' => 'required',
            'item_description' => 'required|string',
            'weight' => 'required|integer',
            'quantity' => 'required|integer',
            'is_dangerous_good' => 'required',

        ]);

        $service_level = $validatedData['service_level'];
        $service_type = $validatedData['service_type'];
        $requested_tracking_number = $validatedData['requested_tracking_number'];
        $merchant_order_number = $validatedData['merchant_order_number'];
        $origin_name = $validatedData['origin_name'];
        $origin_phone = $this->formatPhoneNumber($validatedData['origin_phone']);
        $origin_email = $validatedData['origin_email'];
        $shipping_origin1 = $validatedData['shipping_origin1'];
        $shipping_origin2 = $validatedData['shipping_origin2'];
        $kecamatan_origin = $validatedData['kecamatan_origin'];
        $city_origin = $validatedData['city_origin'];
        $province_origin = $validatedData['province_origin'];
        $address_type_origin = $validatedData['address_type_origin'];
        $country_origin = $validatedData['country_origin'];
        $post_code_origin = $validatedData['post_code_origin'];
        $shipping_name = $validatedData['shipping_name'];
        $shipping_phone = $this->formatPhoneNumber($validatedData['shipping_phone']);
        $shipping_email = $validatedData['shipping_email'];
        $shipping_address1 = $validatedData['shipping_address1'];
        $shipping_address2 = $validatedData['shipping_address2'];
        $kecamatan_destination = $validatedData['kecamatan_destination'];
        $city_destination = $validatedData['city_destination'];
        $province_destination = $validatedData['province_destination'];
        $address_type_destination = $validatedData['address_type_destination'];
        $country_destination = $validatedData['country_destination'];
        $post_code_destination = $validatedData['post_code_destination'];
        $is_pickup_required = $validatedData['is_pickup_required'];
        $pickup_address_id = $validatedData['pickup_address_id'];
        $pickup_service_type = $validatedData['pickup_service_type'];
        $pickup_service_level = $validatedData['pickup_service_level'];
        $cash_on_delivery = $validatedData['cash_on_delivery'];
        $cash_on_delivery_currency = $validatedData['cash_on_delivery_currency'];
        $pickup_instructions = $validatedData['pickup_instructions'];
        $delivery_instructions = $validatedData['delivery_instructions'];
        $delivery_start_date = $validatedData['delivery_start_date'];
        $pickup_date = $validatedData['pickup_date'];
        $start_time = $validatedData['start_time'];
        $end_time = $validatedData['end_time'];
        $timezone = $validatedData['timezone'];
        $item_description = $validatedData['item_description'];
        $weight = $validatedData['weight'];
        $quantity = $validatedData['quantity'];
        $is_dangerous_good = $validatedData['is_dangerous_good'];


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
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'timezone' => $timezone
                ],
                'pickup_instructions' => $pickup_instructions,
                'delivery_instructions' => $delivery_instructions,
                'delivery_start_date' => $delivery_start_date,
                'delivery_timeslot' => [
                    'start_time' => $start_time,
                    'end_time' => $end_time,
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


            // Ubah data menjadi JSON
            $payload = $data;


            $token = TokenNinja::firstOrFail();


            $token = $token->access_token;



            //dd($payload);
            $maxRetries = 3;
            $retryCount = 0;



            do {
                // Send request to third-party API with authorization header
                $client = new Client();
                $response = $client->post('https://api-sandbox.ninjavan.co/sg/4.2/orders', [
                    'json' => $payload,
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                    ],
                ]);



                $retryCount++;

    
                if ($response->getStatusCode() == 200) {
                    $responseBody = json_decode($response->getBody(), true);

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
    }

    protected function formatPhoneNumber($number)
    {
        // Remove leading zero (if any)
        $number = ltrim($number, '0');

        // Prepend country code (+62 for Indonesia)
        $formattedNumber = '+62' . $number;

        return $formattedNumber;
    }

    // public function ninja_order(Request $request)
    // {
    //     try {
    //         $validatedData = $request->validate([
    //             'payment_type' => 'required|string',
    //             'service_type' => 'required|string',
    //             'service_level' => 'required|string|in:Standard,Express,Sameday,Nextday',
    //             'requested_tracking_number' => 'required|string',
    //             'merchant_order_number' => 'required|string',
    //             'origin_name' => 'required|string',
    //             'origin_email' => 'required|string',
    //             'origin_phone' => 'required|string',
    //             'shipping_origin1' => 'required|string',
    //             'shipping_origin2' => 'required|string',
    //             'kecamatan_origin' => 'required|string',
    //             'city_origin' => 'required|string',
    //             'province_origin' => 'required|string',
    //             'address_type_origin' => 'required|string',
    //             'country_origin' => 'required|string',
    //             'post_code_origin' => 'required|string',
    //             'shipping_name' => 'required|string',
    //             'shipping_email' => 'required|string',
    //             'shipping_phone' => 'required|string',
    //             'shipping_address1' => 'required|string',
    //             'shipping_address2' => 'required|string',
    //             'kecamatan_destination' => 'required|string',
    //             'city_destination' => 'required|string',
    //             'province_destination' => 'required|string',
    //             'address_type_destination' => 'required|string',
    //             'country_destination' => 'required|string',
    //             'post_code_destination' => 'required|string',
    //             'notes' => 'required|string',
    //             'weight' => 'required|double',
    //             'currency' => 'required|string',
    //             'shipping_price' => 'required|integer',
    //             'cash_on_delivery' => 'required|integer',
    //             'delivery_start_date' => 'required|date',
    //             'start_time' => 'required|datetime',
    //             'end_time' => 'required|datetime',
    //             'delivery_instructions' => 'required|string',


    //         ]);

    //         $payment_type = $validatedData['payment_type'];
    //         $service_type = $validatedData['service_type'];
    //         $service_level = $validatedData['service_level'];
    //         $requested_tracking_number = $validatedData['requested_tracking_number'];
    //         $merchant_order_number = $validatedData['merchant_order_number'];
    //         $origin_name = $validatedData['origin_name'];
    //         $origin_email = $validatedData['origin_email'];
    //         $origin_phone = $validatedData['origin_phone'];
    //         $shipping_origin1 = $validatedData['shipping_origin1'];
    //         $shipping_origin2 = $validatedData['shipping_origin2'];
    //         $kecamatan_origin = $validatedData['kecamatan_origin'];
    //         $city_origin = $validatedData['city_origin'];
    //         $province_origin = $validatedData['province_origin'];
    //         $address_type_origin = $validatedData['address_type_origin'];
    //         $country_origin = $validatedData['country_origin'];
    //         $post_code_origin = $validatedData['post_code_origin'];
    //         $shipping_name = $validatedData['shipping_name'];
    //         $shipping_email = $validatedData['shipping_email'];
    //         $shipping_phone = $validatedData['shipping_phone'];
    //         $shipping_address1 = $validatedData['shipping_address1'];
    //         $shipping_address2 = $validatedData['shipping_address2'];
    //         $kecamatan_destination = $validatedData['kecamatan_destination'];
    //         $city_destination = $validatedData['city_destination'];
    //         $province_destination = $validatedData['province_destination'];
    //         $address_type_destination = $validatedData['address_type_destination'];
    //         $country_destination = $validatedData['country_destination'];
    //         $post_code_destination = $validatedData['post_code_destination'];
    //         $notes = $validatedData['notes'];
    //         $weight = $validatedData['weight'];
    //         $currency = $validatedData['currency'];
    //         $shipping_price = $validatedData['shipping_price'];
    //         $cash_on_delivery = $validatedData['cash_on_delivery'];


    //         $pickup_date = $validatedData['pickup_date'];
    //         $delivery_start_date = $validatedData['delivery_start_date'];
    //         $start_time = $validatedData['start_time'];
    //         $end_time = $validatedData['end_time'];

    //         $item_description = $validatedData['item_description'];
    //         $quantity = $validatedData['quantity'];


    //         $data = [
    //             'service_type' => $service_type,
    //             'service_level' => $service_level,
    //             'requested_tracking_number' => $requested_tracking_number,
    //             'reference' => [
    //                 'merchant_order_number' => $merchant_order_number,
    //             ],
    //             'from' => [
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
    //                     'postcode' => $post_code_origin,
    //                 ]
    //             ],
    //             'to' => [
    //                 'name' => $shipping_name,
    //                 'phone_number' => $shipping_phone,
    //                 'email' => $shipping_email,
    //                 'address' => [
    //                     'address1' => $shipping_address1,
    //                     'address2' => $shipping_address2,
    //                     'kecamatan' => $kecamatan_destination,
    //                     'city' => $city_destination,
    //                     'province' => $province_destination,
    //                     'address_type' => $address_type_destination,
    //                     'country' => $country_destination,
    //                     'postcode' => $post_code_destination,
    //                 ]
    //             ],
    //             'parcel_job' => [
    //                 'is_pickup_required' => true,
    //                 'pickup_address_id' => '',
    //                 'pickup_service_type' => 'Scheduled',
    //                 'pickup_service_level' => 'Standard',
    //                 'cash_on_delivery' => $cash_on_delivery,
    //                 'cash_on_delivery_currency' => $currency,
    //                 'pickup_date' => $pickup_date,
    //                 'pickup_address' => [
    //                     'name' => $origin_name,
    //                     'phone_number' => $origin_phone,
    //                     'email' => $origin_email,
    //                     'address' => [
    //                         'address1' => $shipping_origin1,
    //                         'address2' => $shipping_origin2,
    //                         'kecamatan' => $kecamatan_origin,
    //                         'city' => $city_origin,
    //                         'province' => $province_origin,
    //                         'address_type' => $address_type_origin,
    //                         'country' => $country_origin,
    //                         'postcode' => $post_code_origin
    //                     ]
    //                 ],
    //                 'pickup_timeslot' => [
    //                     'start_time' => $start_time,
    //                     'end_time' => $end_time,
    //                     'timezone' => 'Asia/Jakarta'
    //                 ],
    //                 'pickup_instructions' => 'Pickup with care!',
    //                 'delivery_instructions' => 'COD (Cash on Delivery)',
    //                 'delivery_start_date' => $delivery_start_date,
    //                 'delivery_timeslot' => [
    //                     'start_time' => $start_time,
    //                     'end_time' => $end_time,
    //                     'timezone' => 'Asia/Jakarta'
    //                 ],
    //                 'dimensions' => [
    //                     'weight' => $weight
    //                 ],
    //                 'items' => [
    //                     [
    //                         'item_description' => $item_description,
    //                         'quantity' => $quantity,
    //                         'is_dangerous_good' => false
    //                     ]
    //                 ]
    //             ]
    //         ];

    //         // Ubah data menjadi JSON
    //         $payload = $data;

    //         // Build the API URL (replace with your actual URL)
    //         $apiUrl = env('SANDBOX_NINJA_ORDER_ENDPOINT');

    //         $countryCode = env('COUNTRY_CODE');
    //         $clientId = env('NINJA_CLIENT_ID');
    //         $clientSecret = env('NINJA_CLIENT_SECRET');

    //         $client = new Client();

    //         $token = $this->getAccessToken();

    //         $expiresAt = $this->getAccessTokenExpiration($token->access_token);
    //         $bufferTime = 5 * 60; // 5 minutes in seconds

    //         $expire = strtotime($expiresAt);
    //         $currentTime = time();

    //         $timeDiff = $expire - $currentTime;

    //         if ($timeDiff <= $bufferTime) {

    //             try {
    //                 $body = [
    //                     'grant_type' => 'client_credentials',
    //                     'client_id' => $clientId,
    //                     'client_secret' => $clientSecret,
    //                 ];

    //                 $response = $client->post('https://api-sandbox.ninjavan.co/' . $countryCode . '/2.0/oauth/access_token', [
    //                     'form_params' => $body,
    //                 ]);

    //                 return response()->json($response->getBody()->getContents());
    //             } catch (\GuzzleHttp\Exception\ClientException $e) {
    //                 if ($e->getResponse()->getStatusCode() === 401) {

    //                     $newToken = $this->generateNewAccessToken($client, $countryCode, $clientId, $clientSecret);

    //                     TokenNinja::where('id', 1)->update([
    //                         'access_token' => $newToken['access_token'],
    //                         'expires' => date('Y-m-d H:i:s', $newToken['expires']),
    //                         'expires_in' => $newToken['expires_in'],
    //                         'token_type' => $newToken['token_type'],

    //                     ]);

    //                     $token = TokenNinja::where('id', 1)->first();

    //                     return response()->json([
    //                         'success' => true,
    //                         'token' => $token,
    //                     ]);
    //                 }

    //                 throw $e;
    //             }

    //             $newToken = $this->generateNewAccessToken($client, $countryCode, $clientId, $clientSecret);

    //             TokenNinja::where('id', 1)->update([
    //                 'access_token' => $newToken['access_token'],
    //                 'expires' => date('Y-m-d H:i:s', $newToken['expires']),
    //                 'expires_in' => $newToken['expires_in'],
    //                 'token_type' => $newToken['token_type'],

    //             ]);

    //             return response()->json([
    //                 'success' => true,
    //                 'token' => $token,
    //             ]);
    //         } else { // Create a Guzzle client with appropriate headers (replace if needed)
    //             return response()->json([
    //                 'success' => false,
    //                 'message' => 'Access token masih aktif.',
    //                 'token' => $token,
    //             ], 401);
    //         }
    //         $client = new Client([
    //             'headers' => [
    //                 'Accept' => 'application/json',
    //                 'Content-Type' => 'application/json',
    //                 'Authorization' => 'Bearer ' . $token,
    //                 // Add any required authentication headers here
    //             ],
    //         ]);

    //         // Send the POST request
    //         $response = $client->post($apiUrl, [
    //             'json' => $payload,
    //         ]);

    //         // Check for successful response
    //         if ($response->getStatusCode() === 200) {
    //             $responseBody = $response->getBody()->getContents();
    //             // Handle successful response here, e.g., return JSON data to frontend
    //             return response()->json([
    //                 'message' => 'Request successful!',
    //                 'data' => json_decode($responseBody),
    //             ]);
    //         } else {
    //             // Handle API errors
    //             throw new Exception("API error: " . $response->getStatusCode() . " - " . $response->getBody()->getContents());
    //         }
    //     } catch (Exception $e) {
    //         // Handle validation errors or other exceptions
    //         return response()->json([
    //             'message' => 'Error: ' . $e->getMessage(),
    //         ], 400);
    //     }
    // }
}
