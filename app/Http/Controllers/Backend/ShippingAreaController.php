<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\District;
use App\Models\NinjaDistrict;
use App\Models\NinjaProvince;
use App\Models\NinjaRegency;
use App\Models\Regency;
use App\Models\TarifNinja;
use App\Models\Village;
use Carbon\Carbon;

class ShippingAreaController extends Controller
{
    public function AllProvince()
    {
        $province = Province::get();
        return view('backend.ship.province.province_all', compact('province'));
    } // End Method 


    public function AllDistrict()
    {
        $district = District::get();
        //$district = District::with('regency.province')->get();
        return view('backend.ship.district.district_all', compact('district'));
    } // End Method 

    public function AllRegency()
    {
        $regency = Regency::get();
        return view('backend.ship.regency.regency_all', compact('regency'));
    } // End Method 

    public function NinjaTarif()
    {
        $ninja = TarifNinja::get();
        return view('backend.ship.ninja.ninja_all', compact('ninja'));
    } // End Method 

    public function NinjaImport()
    {

        return view('backend.ship.ninja.ninja_import');
    } // End Method 

    public function NinjaAllProvince()
    {
        $ninja = NinjaProvince::get();
        return view('backend.ship.ninja.ninja_province', compact('ninja'));
    } // End Method 

    public function NinjaImportProvince()
    {

        return view('backend.ship.ninja.ninja_import_province');
    } // End Method 

    public function NinjaAllRegency()
    {
        $ninja = NinjaRegency::get();
        return view('backend.ship.ninja.ninja_regency', compact('ninja'));
    } // End Method 

    public function NinjaImportRegency()
    {

        return view('backend.ship.ninja.ninja_import_regency');
    } // End Method 

    public function NinjaAllDistrict()
    {
        $ninja = NinjaDistrict::get();
        return view('backend.ship.ninja.ninja_district', compact('ninja'));
    } // End Method 

    public function NinjaImportDistrict()
    {

        return view('backend.ship.ninja.ninja_import_district');
    } // End Method 


    public function StoreNinjaImport(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $line) {
            $data = str_getcsv($line);

            TarifNinja::create([
                'provinsi' => $data[0],
                'kabupaten' => $data[1],
                'kecamatan' => $data[2],
                'l1_tier_code' => $data[3],
                'l2_tier_code' => $data[4],
            ]);
        }
        toastr()->info('File CSV Berhasil Diimport');

        return redirect()->route('ninja.alamat');
    } // End Method 


    public function StoreNinjaProvince(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $line) {
            $data = str_getcsv($line);

            NinjaProvince::create([
                'name' => $data[0],
            ]);
        }
        toastr()->info('File CSV Berhasil Diimport');

        return redirect()->route('ninja.province');
    } // End Method 

    public function StoreNinjaRegency(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $line) {
            $data = str_getcsv($line);

            NinjaRegency::create([
                'ninja_province_id' => $data[0],
                'name' => $data[1]
            ]);
        }
        toastr()->info('File CSV Berhasil Diimport');

        return redirect()->route('ninja.regency');
    } // End Method 

    public function StoreNinjaDistrict(Request $request)
    {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $line) {
            $data = str_getcsv($line);

            NinjaDistrict::create([
                'ninja_regency_id' => $data[0],
                'name' => $data[1],
                'l1_tier_code' => $data[2],
                'l2_tier_code' => $data[3],
            ]);
        }
        toastr()->info('File CSV Berhasil Diimport');

        return redirect()->route('ninja.district');
    } // End Method 


}
