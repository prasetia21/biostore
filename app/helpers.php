<?php

use Illuminate\Support\Facades\Http;

function getData()
{
    $url = env('SERVICE_TEST_URL') . 'users';
    try {
        $response = Http::get($url);
        
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



function getLokasi()
{
    $url = env('SAMPLE_RAJA_ONGKIR');
    try {
        $response = Http::withHeaders(['key' => env('RAJAONGKIR_API_KEY')])->get($url);
        
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

function getLokasiId($id) {
    $url = env('SAMPLE_RAJA_ONGKIR2').'province?id='.$id;

    try {
        $response = Http::withHeaders(['key' => env('RAJAONGKIR_API_KEY')])->timeout(10)->get($url);
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

function postDataTes($params)
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
