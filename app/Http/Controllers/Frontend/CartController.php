<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RajaCity;
use App\Models\RajaProvince;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\NinjaRegency;
use App\Models\ShippingAddress;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        if (Auth::check()) {

            if (Session::has('coupon')) {
                Session::forget('coupon');
            }
            $product = Product::findOrFail($id);

            $dimensi = ceil(($product->product_dimension_x * $product->product_dimension_y * $product->product_dimension_z) / 6000);
            $beratProduk = $product->product_weight + $dimensi;

            if ($product->discount_price == NULL) {

                Cart::add([

                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $product->selling_price,
                    'weight' => $beratProduk,
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'color' => $request->color,
                        'size' => $request->size,
                        'width' => $product->product_dimension_x,
                        'length' => $product->product_dimension_y,
                        'height' => $product->product_dimension_z,
                    ],

                ]);


                return response()->json(['success' => 'Berhasil ditambahkan ke Keranjang Belanja']);
            } else {

                Cart::add([

                    'id' => $id,
                    'name' => $request->product_name,
                    'qty' => $request->quantity,
                    'price' => $product->discount_price,
                    'weight' => $beratProduk,
                    'options' => [
                        'image' => $product->product_thumbnail,
                        'color' => $request->color,
                        'size' => $request->size,
                        'width' => $product->product_dimension_x,
                        'length' => $product->product_dimension_y,
                        'height' => $product->product_dimension_z,
                    ],
                ]);

                return response()->json(['success' => 'Berhasil ditambahkan ke Keranjang Belanja']);
            }
        } else {
            return response()->json(['error' => 'Harap Login Terlebih Dahulu!!!']);
        }
    } // End Method

    public function AddToCartDetails(Request $request, $id)
    {

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $product = Product::findOrFail($id);
        $dimensi = ceil(($product->product_dimension_x * $product->product_dimension_y * $product->product_dimension_z) / 6000);
        $beratProduk = $product->product_weight + $dimensi;

        if ($product->discount_price == NULL) {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => $beratProduk,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                    'width' => $product->product_dimension_x,
                    'length' => $product->product_dimension_y,
                    'height' => $product->product_dimension_z,
                ],
            ]);

            return response()->json(['success' => 'Berhasil ditambahkan ke Keranjang Belanja']);
        } else {

            Cart::add([

                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => $beratProduk,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor' => $request->vendor,
                    'width' => $product->product_dimension_x,
                    'length' => $product->product_dimension_y,
                    'height' => $product->product_dimension_z,
                ],
            ]);

            return response()->json(['success' => 'Berhasil ditambahkan ke Keranjang Belanja']);
        }
    } // End Method

    public function AddMiniCart()
    {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(
            array(
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => $cartTotal

            )
        );
    } // End Method

    public function RemoveMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);
    } // End Method

    public function MyCart()
    {

        return view('frontend.mycart.view_mycart');
    } // End Method

    public function GetCartProduct()
    {

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(
            array(
                'carts' => $carts,
                'cartQty' => $cartQty,
                'cartTotal' => $cartTotal

            )
        );
    } // End Method

    public function CartRemove($rowId)
    {
        Cart::remove($rowId);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => intval(preg_replace('/[^\d.]/', '', Cart::total()) * $coupon->coupon_discount / 100),
                'total_amount' => intval(preg_replace('/[^\d.]/', '', Cart::total()) - Cart::total() * $coupon->coupon_discount / 100)
            ]);
        }


        return response()->json(['success' => 'Successfully Remove From Cart']);
    } // End Method

    public function CartDecrement($rowId)
    {

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => intval(preg_replace('/[^\d.]/', '', Cart::total()) * $coupon->coupon_discount / 100),
                'total_amount' => intval(preg_replace('/[^\d.]/', '', Cart::total()) - Cart::total() * $coupon->coupon_discount / 100)
            ]);
        }


        return response()->json('Decrement');
    } // End Method

    public function CartIncrement($rowId)
    {

        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => intval(preg_replace('/[^\d.]/', '', Cart::total()) * $coupon->coupon_discount / 100),
                'total_amount' => intval(preg_replace('/[^\d.]/', '', Cart::total()) - Cart::total() * $coupon->coupon_discount / 100)
            ]);
        }

        return response()->json('Increment');
    } // End Method

    public function CouponApply(Request $request)
    {

        $coupon = Coupon::where('coupon_name', 'RLIKE', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => intval(preg_replace('/[^\d.]/', '', Cart::total())) * $coupon->coupon_discount / 100,
                'total_amount' => intval(preg_replace('/[^\d.]/', '', Cart::total())) - intval(preg_replace('/[^\d.]/', '', Cart::total())) * $coupon->coupon_discount / 100,
            ]);

            return response()->json(
                array(
                    'validity' => true,
                    'success' => 'Coupon Applied Successfully'

                )
            );
        } else {
            return response()->json(['error' => 'Invalid Coupon']);
        }
    } // End Method

    public function CouponCalculation()
    {

        if (Session::has('coupon')) {

            return response()->json(
                array(
                    'subtotal' => intval(preg_replace('/[^\d.]/', '', Cart::total())),
                    'coupon_name' => session()->get('coupon')['coupon_name'],
                    'coupon_discount' => session()->get('coupon')['coupon_discount'],
                    'discount_amount' => session()->get('coupon')['discount_amount'],
                    'total_amount' => session()->get('coupon')['total_amount'],
                )
            );
        } else {
            return response()->json(
                array(
                    'total' => intval(preg_replace('/[^\d.]/', '', Cart::total())),
                )
            );
        }
    } // End Method

    public function CouponRemove()
    {

        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    } // End Method

    public function check_ongkir(Request $request)
    {
        $kota_asal = 501;

        $cost = RajaOngkir::ongkosKirim([
            'origin' => $kota_asal,
            // ID kota/kabupaten asal
            'destination' => $request->city_destination,
            // ID kota/kabupaten tujuan
            'weight' => $request->weight,
            // berat barang dalam gram
            'courier' => $request->courier // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();


        return response()->json($cost);
    }




    public function getCities($id)
    {
        $city = RajaCity::where('raja_province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    public function CheckoutCreate()
    {

        if (Auth::check()) {

            if (Cart::total() > 0) {

                $address = ShippingAddress::where('user_id', Auth::id())->count();

                if ($address > 0) {

                    if (Session::has('coupon')) {
                        $provinces = RajaProvince::pluck('name', 'raja_province_id');
                        $carts = Cart::content();
                        $cartQty = Cart::count();
                        $cartTotal = session()->get('coupon')['total_amount'];
                        $address = ShippingAddress::where('user_id', Auth::id())->first();

                        return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'provinces', 'address'));
                    } else {
                        $provinces = RajaProvince::pluck('name', 'raja_province_id');
                        $carts = Cart::content();
                        $cartQty = Cart::count();
                        $cartTotal = Cart::total();
                        $address = ShippingAddress::where('user_id', Auth::id())->first();

                        return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'provinces', 'address'));
                    }
                } else {

                    toastr()->error('Mohon Lengkapi data Alamat Pengiriman Anda!!!');

                    return redirect()->to('dashboard');
                }
            } else {

                toastr()->error('Keranjang Belanja Anda masih Kosong!!!');

                return redirect()->to('/');
            }
        } else {

            toastr()->error('Login untuk Melanjutkan Berbelanja!!!');

            return redirect()->route('login');
        }
    } // End Method
}
