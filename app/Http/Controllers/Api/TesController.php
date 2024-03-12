<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TesController extends Controller
{
    public function index(Request $request, $id)
    {
        
        $data = getLokasiId($id);
        $data = $request->header('Authorization',"Bearer ".$request->bearerToken());
        //dd($data);

        // berikan respon jika data berhasil dipanggil
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    public function posting(Request $request)
    {
        $data = postData([
            "name" => "Lorem Graham",
            "username" => "Lorem",
            "email" => "lorem@march.biz",
            "address" => [
                "street" => "Chorus Light",
                "suite" => "Apt. 556",
                "city" => "Arizona",
                "zipcode" => "92998-3874",
                "geo" => [
                    "lat" => "-37.3159",
                    "lng" => "81.1496",
                ],
            ],
            "phone" => "1-770-736-8031 x56442",
            "website" => "loremipsum.org",
            "company" => [
                "name" => "Rodri-Corona",
                "catchPhrase" => "Multi-layered client-server neural-net",
                "bs" => "harness real-time e-markets",
            ]
        ]);
        

        // berikan respon jika data berhasil dipanggil
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
