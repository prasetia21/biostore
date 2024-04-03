<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gudang;
use App\Models\NinjaProvince;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function AllGudang()
    {
        $gudangs = Gudang::with('province')->with('city')->with('district')->latest()->get();

        return view('backend.gudang.gudang_all', compact('gudangs'));
    } // End Method 

    public function AddGudang()
    {
        $provinces = NinjaProvince::pluck('name', 'id');

        return view('backend.gudang.gudang_add', compact('provinces'));
    } // End Method 

    public function StoreGudang(Request $request){

        Gudang::insert([
            'label' => $request->label,
            'pic_name' => $request->pic_name,
            'ninja_province_id' => $request->ninja_province_id,
            'ninja_regency_id' => $request->ninja_regency_id,
            'ninja_district_id' => $request->ninja_district_id,
            'post_code' => $request->post_code,
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
            'address' => $request->address,
            
        ]);

      
        toastr()->info('Gudang Berhasil Ditambahkan');

        return redirect()->route('all.gudang'); 

    }// End Method 

    public function EditGudang(Request $request){

        Gudang::insert([
            'label' => $request->label,
            'pic_name' => $request->pic_name,
            'ninja_province_id' => $request->ninja_province_id,
            'ninja_regency_id' => $request->ninja_regency_id,
            'ninja_district_id' => $request->ninja_district_id,
            'post_code' => $request->post_code,
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
            'address' => $request->address,
            
        ]);

      
        toastr()->info('Gudang Berhasil Ditambahkan');

        return redirect()->route('all.gudang'); 

    }// End Method 

    public function DeleteGudang($id){

        Gudang::findOrFail($id)->delete();

        toastr()->success('Gudang Berhasil Dihapus');

        return redirect()->back(); 

    }// End Method 

}
