<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IndoregionController extends Controller
{

    public function index(Request $request)
    {
        return view('frontend.indoregion.index');
    }

    public function provinces()
    {
        return Province::all();
    }

    public function regencies(Request $request)
    {
        // return Regency::where('province_id', $provinces_id)->get();
        return Regency::where('province_id', $request->id)->get()->pluck('name', 'id');
    }

    public function districts(Request $request)
    {
        // return District::where('regency_id', $regency_id)->get();
        return District::where('regency_id', $request->id)->get()->pluck('name', 'id');
    }

    public function villages(Request $request)
    {
        // return Village::where('district_id', $district_id)->get()->pluck('name', 'id');
        return Village::where('district_id', $request->id)->get()->pluck('name', 'id');
    }
}