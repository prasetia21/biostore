<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Str;

class VoucherController extends Controller
{
    public function AllVoucher()
    {
        $voucher = Voucher::latest()->get();
        return view('backend.voucher.voucher_all', compact('voucher'));
    } // End Method 


    public function AddVoucher()
    {
        return view('backend.voucher.voucher_add');
    } // End Method 


    public function StoreVoucher(Request $request)
    {

        Voucher::insert([
            'code' => Str::random(12),
            'name' => strtoupper($request->name),
            'description' => $request->description,
            'max_uses' => $request->max_uses,
            'max_uses_user' => $request->max_uses_user,
            'type' => $request->type,
            'nominal' => $request->nominal,
            'expires_at' => $request->expires_at,
            'created_at' => Carbon::now(),
        ]);

        toastr()->info('Voucher Berhasil Ditambahkan');

        return redirect()->route('all.voucher');

    } // End Method 


    public function EditVoucher($id)
    {

        $voucher = Voucher::findOrFail($id);
        return view('backend.voucher.edit_voucher', compact('voucher'));

    } // End Method 


    public function UpdateVoucher(Request $request)
    {

        $voucher_id = $request->id;

        Voucher::findOrFail($voucher_id)->update([
            'name' => strtoupper($request->name),
            'description' => $request->description,
            'max_uses' => $request->max_uses,
            'max_uses_user' => $request->max_uses_user,
            'type' => $request->type,
            'nominal' => $request->nominal,
            'expires_at' => $request->expires_at,
            'created_at' => Carbon::now(),
        ]);

        toastr()->success('Voucher Berhasil Diupdate');

        return redirect()->route('all.voucher');


    } // End Method 

    public function DeleteVoucher($id)
    {

        Voucher::findOrFail($id)->delete();

        toastr()->success('Voucher Berhasil Dihapus');

        return redirect()->back();


    } // End Method 

}