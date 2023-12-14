<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function AllColor()
    {
        $color = Color::latest()->get();
        return view('backend.color.color_all', compact('color'));
    } // End Method 


    public function AddColor()
    {
        $colors = Color::latest()->get();
        return view('backend.color.color_add', compact('colors'));
    } // End Method 



    public function StoreColor(Request $request)
    {
        Color::insert([
            'color_name' => $request->color_name,
            'color_slug' => strtolower(str_replace(' ', '-', $request->color_name)),
        ]);


        toastr()->info('Warna Berhasil Ditambahakan');

        return redirect()->route('all.color');

    } // End Method 



    public function EditColor($id)
    {
        $color = Color::findOrFail($id);
        return view('backend.color.color_edit', compact('color'));
    } // End Method 


    public function UpdateColor(Request $request)
    {

        $opt_group_id = $request->id;

        Color::findOrFail($opt_group_id)->update([
            'color_name' => $request->color_name,
            'color_slug' => strtolower(str_replace(' ', '-', $request->color_name)),
        ]);

        toastr()->success('Warna Berhasil Diupdate');

        return redirect()->route('all.color');

    } // End Method 


    public function DeleteColor($id)
    {

        Color::findOrFail($id)->delete();

        toastr()->success('Warna Berhasil Dihapus');

        return redirect()->back();

    } // End Method 
}