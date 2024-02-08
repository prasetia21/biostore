<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\TarifNinja;
use Illuminate\Http\Request;

class NinjaWilayahIndoController extends Controller
{
    public function index()
    {
        $provinsi = TarifNinja::provinsi()->pluck('provinsi', 'l1_tier_code');

        return view('wilayah.index', compact('provinsi'));
    }

    public function getKabupaten(Request $request)
    {
        $kabupaten = TarifNinja::kabupaten($request->l1_tier_code)->pluck('kabupaten', 'l2_tier_code');

        return response()->json($kabupaten);
    }
}
