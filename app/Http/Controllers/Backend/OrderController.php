<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderShipping;
use App\Models\Product;
use App\Models\RajaCity;
use App\Models\RajaProvince;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class OrderController extends Controller
{
    public function PendingOrder()
    {
        $orders = Order::where('status', 'pending')->orderBy('id', 'DESC')->get();
        return view('backend.orders.pending_orders', compact('orders'));
    } // End Method 


    public function AdminOrderDetails($order_id)
    {

        $cekOrder = Order::where('id', $order_id)->first();

        if (!empty($cekOrder->user_id)) {
            $order = Order::with('province', 'city', 'user')->where('id', $order_id)->first();

            $addressProvince = RajaProvince::where('raja_province_id', $order->raja_province_id)->first();
            $addressCity = RajaCity::where('city_id', $order->city_id)->first();

            $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

            return view('backend.orders.admin_order_details', compact('order', 'orderItem', 'addressProvince', 'addressCity'));
        } else {
            $order = Order::with('province', 'city', 'guest')->where('id', $order_id)->first();

            $addressProvince = RajaProvince::where('raja_province_id', $order->raja_province_id)->first();
            $addressCity = RajaCity::where('city_id', $order->city_id)->first();

            $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();

            return view('backend.orders.guest.admin_order_details', compact('order', 'orderItem', 'addressProvince', 'addressCity'));
        }
    } // End Method 


    public function AdminConfirmedOrder()
    {
        $orders = Order::where('status', 'confirm')->orderBy('id', 'DESC')->get();
        return view('backend.orders.confirmed_orders', compact('orders'));
    } // End Method 


    public function AdminProcessingOrder()
    {
        $orders = Order::where('status', 'paid')->orderBy('id', 'DESC')->get();
        return view('backend.orders.processing_orders', compact('orders'));
    } // End Method 


    public function AdminDeliveredOrder()
    {
        $orders = Order::where('status', 'deliverd')->orderBy('id', 'DESC')->get();
        return view('backend.orders.delivered_orders', compact('orders'));
    } // End Method 


    public function PendingToConfirm($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'confirm']);

        toastr()->success('Pesanan Berhasil Dikonfirmasi');

        return redirect()->route('admin.confirmed.order');
    } // End Method 

    public function ConfirmToProcess($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'paid']);

        toastr()->success('Pesanan Berhasil Diproses');

        return redirect()->route('admin.processing.order');
    } // End Method 


    public function ProcessToDelivered($order_id)
    {

        $product = OrderItem::where('order_id', $order_id)->get();
        foreach ($product as $item) {
            Product::where('id', $item->product_id)
                ->update(['product_qty' => DB::raw('product_qty-' . $item->qty)]);
        }

        Order::findOrFail($order_id)->update(['status' => 'deliverd']);

        toastr()->success('Pesanan Berhasil Dikirimkan');

        return redirect()->route('admin.delivered.order');
    } // End Method 


    public function AdminInvoiceDownload($order_id)
    {

        $cekOrder = Order::where('id', $order_id)->first();

        if (!empty($cekOrder->user_id)) {
            $order = Order::with('province', 'city', 'user')->where('id', $order_id)->first();

            $addressProvince = RajaProvince::where('raja_province_id', $order->raja_province_id)->first();
            $addressCity = RajaCity::where('city_id', $order->city_id)->first();

            $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
            $orderShip = OrderShipping::where('order_id', $order_id)->orderBy('id', 'DESC')->get();

            $pdf = Pdf::loadView('backend.orders.admin_order_invoice', compact('order', 'orderItem', 'orderShip', 'addressProvince', 'addressCity'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('invoice.pdf');
        } else {
            $order = Order::with('province', 'city', 'guest')->where('id', $order_id)->first();

            $addressProvince = RajaProvince::where('raja_province_id', $order->raja_province_id)->first();
            $addressCity = RajaCity::where('city_id', $order->city_id)->first();

            $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
            $orderShip = OrderShipping::where('order_id', $order_id)->orderBy('id', 'DESC')->get();

            $pdf = Pdf::loadView('backend.orders.admin_order_invoice', compact('order', 'orderItem', 'orderShip', 'addressProvince', 'addressCity'))->setPaper('a4')->setOption([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
            return $pdf->download('invoice.pdf');
        }
    } // End Method 



}
