<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\IsiPaket;
use App\Models\MultiImgPaket;
use App\Models\Paket;
use App\Models\Product;
use Carbon\Carbon;
use Image;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function AllPaket()
    {
        $pakets = Paket::latest()->get();
        return view('backend.paket.paket_all', compact('pakets'));
    } // End Method 


    public function AddPaket()
    {
        $products = Product::latest()->get();

        return view('backend.paket.paket_add', compact('products'));
    } // End Method 

    public function StorePaket(Request $request)
    {
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('upload/paket/thumbnail/' . $name_gen);
        $save_url = 'upload/paket/thumbnail/' . $name_gen;

        $product_list = $request->product_id;

        //string to array
        //$splitString = preg_split("/[,]/", $product_colors);

        //dd($splitString);
        $paket_id = Paket::create([

            'nama_paket' => $request->nama_paket,
            'image' => $save_url,
            'status' => 1,
        ]);

        foreach ($product_list as $list) {
            IsiPaket::insert([

                'paket_id' => $paket_id->id,
                'product_id' => $list,
                'qty' => $request->qty,
                'new_price' => $request->new_price,
            ]);
        }

        /// Multiple Image Upload From her //////

        $images = $request->file('multi_img');


        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(800, 800)->save('upload/paket/multi-image/' . $make_name);
            $uploadPath = 'upload/paket/multi-image/' . $make_name;


            MultiImgPaket::insert([

                'paket_id' => $paket_id->id,
                'image_name' => $uploadPath,

            ]);
        } // end foreach

        /// End Multiple Image Upload From her //////

        toastr()->info('Paket Berhasil Ditambahkan');

        return redirect()->route('all.paket');
    } // End Method 
}
