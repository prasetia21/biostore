<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Seo;
use Image;

class SiteSettingController extends Controller
{
    public function SiteSetting(){

        $setting = SiteSetting::find(1);
        return view('backend.setting.setting_update',compact('setting'));

    } // End Method 


public function SiteSettingUpdate(Request $request){

        $setting_id = $request->id; 

        if ($request->file('logo')) {

        $image = $request->file('logo');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(180,56)->save('upload/logo/'.$name_gen);
        $save_url = 'upload/logo/'.$name_gen;

        
        SiteSetting::findOrFail($setting_id)->update([
            'support_phone' => $request->support_phone,
            'phone_one' => $request->phone_one,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'copyright' => $request->copyright, 
            'logo' => $save_url, 
        ]);


        toastr()->success('Pengaturan Situs Bergambar Berhasil Diupdate');

        return redirect()->back(); 

        } else {

            SiteSetting::findOrFail($setting_id)->update([
            'support_phone' => $request->support_phone,
            'phone_one' => $request->phone_one,
            'email' => $request->email,
            'company_address' => $request->company_address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'copyright' => $request->copyright, 
        ]);

        toastr()->success('Pengaturan Situs Berhasil Diupdate');

        return redirect()->back(); 

        } // end else

    }// End Method 
 

 public function SeoSetting(){

        $seo = Seo::find(1);
        return view('backend.seo.seo_update',compact('seo'));

    } // End Method 


    public function SeoSettingUpdate(Request $request){
        $seo_id = $request->id;

     Seo::findOrFail($seo_id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description, 
        ]);

        toastr()->success('Pengaturan SEO Situs Berhasil Diupdate');

        return redirect()->back();  

    }// End Method 

}
 