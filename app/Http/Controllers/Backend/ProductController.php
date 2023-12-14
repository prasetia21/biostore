<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function AllProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    } // End Method 


    public function AddProduct()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $colors = Color::latest()->get();

        return view('backend.product.product_add', compact('brands', 'categories', 'colors'));

    } // End Method 



    public function StoreProduct(Request $request)
    {
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        $product_colors = json_encode($request->product_color);

        //string to array
        //$splitString = preg_split("/[,]/", $product_colors);

        //dd($splitString);
        $product_id = Product::create([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_weight' => $request->product_weight,
            'product_size' => $request->product_size,
            'product_color' => $product_colors,


            'product_dimension_x' => $request->product_dimension_x,
            'product_dimension_y' => $request->product_dimension_y,
            'product_dimension_z' => $request->product_dimension_z,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,

            'featured' => $request->featured,

            'product_thumbnail' => $save_url,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);



        /// Multiple Image Upload From her //////

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(800, 800)->save('upload/products/multi-image/' . $make_name);
            $uploadPath = 'upload/products/multi-image/' . $make_name;


            MultiImg::insert([

                'product_id' => $product_id->id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        } // end foreach

        /// End Multiple Image Upload From her //////

        toastr()->info('Produk Berhasil Ditambahkan');

        return redirect()->route('all.product');


    } // End Method 


    public function EditProduct($id)
    {

        $multiImgs = MultiImg::where('product_id', $id)->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('brands', 'categories', 'activeVendor', 'products', 'subcategory', 'multiImgs'));
    } // End Method 


    public function UpdateProduct(Request $request)
    {

        $product_id = $request->id;

        Product::findOrFail($product_id)->update([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_weight' => $request->product_size,

            'product_dimension_x' => $request->product_dimension_x,
            'product_dimension_y' => $request->product_dimension_y,
            'product_dimension_z' => $request->product_dimension_z,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,

            'featured' => $request->featured,
            
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);


        toastr()->success('Produk Berhasil Diupdate');

        return redirect()->route('all.product');

    } // End Method 




    public function UpdateProductThumbnail(Request $request)
    {

        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Product::findOrFail($pro_id)->update([

            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        toastr()->success('Gambar Muka Produk Berhasil Diupdate');

        return redirect()->back();


    } // End Method 

    // Multi Image Update 
    public function UpdateProductMultiimage(Request $request)
    {

        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(800, 800)->save('upload/products/multi-image/' . $make_name);
            $uploadPath = 'upload/products/multi-image/' . $make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);
        } // end foreach

        toastr()->success('Produk Bergambar Berhasil Diupdate');

        return redirect()->back();

    } // End Method 



    public function MulitImageDelelte($id)
    {
        $oldImg = MultiImg::findOrFail($id);
        unlink($oldImg->photo_name);

        MultiImg::findOrFail($id)->delete();

        toastr()->success('Produk Bergambar Berhasil Dihapus');

        return redirect()->back();

    } // End Method 


    public function ProductInactive($id)
    {

        Product::findOrFail($id)->update(['status' => 0]);
     
        toastr()->success('Produk Berhasil Dinon-Aktifkan');

        return redirect()->back();

    } // End Method 


    public function ProductActive($id)
    {

        Product::findOrFail($id)->update(['status' => 1]);

        toastr()->success('Produk Berhasil Diaktifkan');

        return redirect()->back();

    } // End Method 


    public function ProductDelete($id)
    {

        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $imges = MultiImg::where('product_id', $id)->get();
        foreach ($imges as $img) {
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        toastr()->success('Produk Berhasil Dihapus');

        return redirect()->back();

    } // End Method 

    public function ProductStock()
    {

        $products = Product::latest()->get();
        return view('backend.product.product_stock', compact('products'));

    } // End Method 

}