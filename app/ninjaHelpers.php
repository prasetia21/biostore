<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

// get token
function getNinjaToken()
{
    $url = env('SANDBOX_NINJA_AUTH_ENDPOINT');
    try {
        $response = Http::asForm()->withToken('token')->post($url, [
            'client_id' => env('NINJA_CLIENT_ID'),
            'client_secret' => env('NINJA_CLIENT_SECRET'),
            'grant_type' => env('GRANT_TYPE'),
        ]);

        $data = $response->json();
        $data['http_code'] = $response->getStatusCode();
        return $data;
    } catch (\Throwable $th) {
        return [
            'status' => 'error',
            'http_code' => 500,
            'message' => 'service unavailable'
        ];
    }
}




function postData($params)
{
    $url = env('SERVICE_TEST_URL') . 'users';
    try {
        $response = Http::post($url, $params);
        $data = $response->json();
        $data['http_code'] = $response->getStatusCode();
        return $data;
    } catch (\Throwable $th) {
        return [
            'status' => 'error',
            'http_code' => 500,
            'message' => 'service unavailable'
        ];
    }
}
