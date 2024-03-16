<?php

namespace App\Http\Controllers\Guest\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderNinja;
use App\Models\OrderShipping;
use Barryvdh\DomPDF\Facade\Pdf;

class AllGuestController extends Controller
{
    public function UserTrackOrder()
    {
        return view('frontend.userdashboard.guest.user_track_order');
    } // End Method 

    public function OrderTracking(Request $request)
    {

        $invoice = $request->code;

        $track = OrderNinja::where('requested_tracking_number', $invoice)->first();

        if ($track) {
            return view('frontend.traking.guest.track_order', compact('track'));

        } else {

          

            toastr()->error('Kode Invoice Tidak Sesuai!!!');

            return redirect()->back();
        }

    } // End Method 

    public function GuestOrderInvoice($order_id)
    {

        $order = OrderNinja::with('province', 'city', 'user')->where('id', $order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_ninja_id', $order_id)->orderBy('order_ninja_id', 'DESC')->get();

        $pdf = Pdf::loadView('frontend.order.guest.order_invoice', compact('order', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    } // End Method 

}