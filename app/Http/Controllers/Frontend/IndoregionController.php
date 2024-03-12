<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\NinjaDistrict;
use App\Models\NinjaRegency;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IndoregionController extends Controller
{

    public function getNinjaCities($id)
    {
        $city = NinjaRegency::where('ninja_province_id', $id)->pluck('name', 'id');
        return response()->json($city);
    }

    public function getNinjaDistricts($id)
    {
        $district = NinjaDistrict::where('ninja_regency_id', $id)->pluck('name', 'id', 'l1_tier_code', 'l2_tier_code');
        return response()->json($district);
    }

    public function getNinjaKodeDistricts($id)
    {
        
        $code = NinjaDistrict::where('id', $id)->first(['l1_tier_code', 'l2_tier_code']);
        return response()->json($code);
    }

    // public function index(Request $request)
    // {
    //     return view('frontend.indoregion.index');
    // }

    // public function provinces()
    // {
    //     return Province::all();
    // }

    


    // public function regencies(Request $request)
    // {
    //     // return Regency::where('province_id', $provinces_id)->get();
    //     return Regency::where('province_id', $request->id)->get()->pluck('name', 'id');
    // }

    // public function districts(Request $request)
    // {
    //     // return District::where('regency_id', $regency_id)->get();
    //     return District::where('regency_id', $request->id)->get()->pluck('name', 'id');
    // }

    // public function villages(Request $request)
    // {
    //     // return Village::where('district_id', $district_id)->get()->pluck('name', 'id');
    //     return Village::where('district_id', $request->id)->get()->pluck('name', 'id');
    // }
}