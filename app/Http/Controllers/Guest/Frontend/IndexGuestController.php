<?php

namespace App\Http\Controllers\Guest\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MultiImg;
use App\Models\Product;
use App\Models\Reward;
use App\Models\Slider;

class IndexGuestController extends Controller
{
    public function Index()
    {
        $slider = Slider::orderBy('slider_title', 'ASC')->get();

        $categories = Category::orderBy('category_name', 'ASC')->get();

        $reward = Reward::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();

        $catalogProduct = Product::where('status', 1)->get();



        if (count($catalogProduct) == 0) {
            // make message here no results, pass to view
            $message = 'katalog produk kosong';

            return view('frontend.guest', compact('message'));
        }

        return view('frontend.guest', compact('slider', 'categories', 'reward', 'catalogProduct'));
    } // End Method 

    public function ProductDetails(string $slug, int $id)
    {

        $product = Product::findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        $multiImage = MultiImg::where('product_id', $id)->get();

        $cat_id = $product->category_id;
        $relatedProduct = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();

        return view('frontend.product.guest.product_details', compact('product', 'product_color', 'product_size', 'multiImage', 'relatedProduct'));
    } // End Method 

    public function CatWiseProduct(Request $request, string $slug, int $id)
    {
        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();

        $breadcat = Category::where('id', $id)->first();

        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.product.guest.category_view', compact('products', 'categories', 'breadcat', 'newProduct'));
    } // End Method 


    public function SubCatWiseProduct(Request $request, string $slug, int $id)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name', 'ASC')->get();

        $breadsubcat = SubCategory::where('id', $id)->first();

        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();

        return view('frontend.product.guest.subcategory_view', compact('products', 'categories', 'breadsubcat', 'newProduct'));
    } // End Method 


    public function ProductViewAjax($id)
    {

        $product = Product::with('category', 'brand')->findOrFail($id);
        $color = $product->product_color;
        $product_color = explode(',', $color);

        $size = $product->product_size;
        $product_size = explode(',', $size);

        return response()->json(
            array(

                'product' => $product,
                'color' => $product_color,
                'size' => $product_size,

            )
        );
    } // End Method 


    public function ProductSearch(Request $request)
    {

        $request->validate(['search' => "required"]);

        $item = $request->search;
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $products = Product::where('product_name', 'LIKE', "%$item%")->get();
        $newProduct = Product::orderBy('id', 'DESC')->limit(3)->get();
        return view('frontend.product.guest.search', compact('products', 'item', 'categories', 'newProduct'));
    } // End Method 

    public function SearchProduct(Request $request)
    {

        $request->validate(['search' => "required"]);

        $item = $request->search;
        $products = Product::where('product_name', 'LIKE', "%$item%")->select('product_name', 'product_slug', 'product_thumbnail', 'selling_price', 'id')->limit(6)->get();

        return view('frontend.product.guest.search_product', compact('products'));
    } // End Method 

}
