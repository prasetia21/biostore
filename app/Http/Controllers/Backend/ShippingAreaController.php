<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Models\Regency;
use App\Models\Village;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    public function AllProvince(){
        $province = Province::get();
        return view('backend.ship.province.province_all',compact('province'));
    } // End Method 


     public function AllDistrict(){
        $district = District::get();
        //$district = District::with('regency.province')->get();
        return view('backend.ship.district.district_all',compact('district'));
    } // End Method 

     public function AllRegency(){
        $regency = Regency::get();
        return view('backend.ship.regency.regency_all',compact('regency'));
    } // End Method 

}
 