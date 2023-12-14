<?php

namespace App\Http\Controllers\Guest\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Regency;

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



    public function CheckoutStore(Request $request)
    {
        $data = array();

        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;

        $data['province_destination'] = $request->province_destination;
        $data['city_destination'] = $request->city_destination;
        $data['shipping_address'] = $request->shipping_address;
        $data['notes'] = $request->notes;

        $data['weight'] = $request->weight;
        $data['shipping_price'] = $request->shipping_price;
        $data['shipping_expedition'] = $request->shipping_expedition;
        $data['shipping_service'] = $request->shipping_service;
        $data['shipping_estimation'] = $request->shipping_estimation;

        $data['total'] = $request->grand_total_price;
        //$cartTotal = Cart::total();

        if ($request->payment_option == 'midtrans') {
            return view('frontend.payment.guest.midtrans', compact('data'));
        } else {
            return view('frontend.payment.guest.cash', compact('data'));
        }


    } // End Method 
}