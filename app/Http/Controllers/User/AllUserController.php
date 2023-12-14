<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MyReward;
use App\Models\Point;
use App\Models\ReferralRelationship;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderShipping;
use App\Models\RajaCity;
use App\Models\RajaProvince;
use App\Models\ShippingAddress;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AllUserController extends Controller
{
    public function UserAccount()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.userdashboard.account_details', compact('userData'));

    } // End Method 

    public function UserProfile()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);

        return view('frontend.userdashboard.user_profile', compact('userData'));

    } // End Method 

    public function UserAddAddress()
    {

        $provinces = RajaProvince::pluck('name', 'raja_province_id');

        return view('frontend.userdashboard.user_add_address', compact('provinces'));

    } // End Method 

    public function UserEditAddress()
    {
        $address = ShippingAddress::where('user_id', Auth::id())->first();
        $provinces = RajaProvince::pluck('name', 'raja_province_id');
        $addressProvince = ShippingAddress::with('province')->where('user_id', Auth::id())->first();
        $addressCity = RajaCity::where('city_id', $address->city_id)->first();
  

        return view('frontend.userdashboard.user_edit_address', compact('provinces', 'address', 'addressProvince', 'addressCity'));

    } // End Method 


    public function UserChangePassword()
    {
        return view('frontend.userdashboard.user_change_password');
    } // End Method 


    public function UserOrderPage()
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.userdashboard.user_order_page', compact('orders'));
    } // End Method 


    public function UserOrderDetails($order_id)
    {

        $order = Order::with('province', 'city', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();

        $addressProvince = RajaProvince::where('raja_province_id', $order->raja_province_id)->first();
        $addressCity = RajaCity::where('city_id', $order->city_id)->first();

        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $orderShip = OrderShipping::where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        return view('frontend.order.order_details', compact('order', 'orderItem', 'orderShip', 'addressProvince', 'addressCity'));

    } // End Method 


    public function UserOrderInvoice($order_id)
    {

        $order = Order::with('province', 'city', 'user')->where('id', $order_id)->where('user_id', Auth::id())->first();
        
        $addressProvince = RajaProvince::where('raja_province_id', $order->raja_province_id)->first();
        $addressCity = RajaCity::where('city_id', $order->city_id)->first();

        

        $orderItem = OrderItem::with('product')->where('order_id', $order_id)->orderBy('id', 'DESC')->get();
        $orderShip = OrderShipping::where('order_id', $order_id)->orderBy('id', 'DESC')->get();

        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order', 'orderItem', 'orderShip', 'addressProvince', 'addressCity'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    } // End Method 



    public function ReturnOrder(Request $request, $order_id)
    {

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);

        toastr()->success('Request Pengembalian Berhasil Terkirim');

        return redirect()->route('user.order.page');

    } // End Method 


    public function ReturnOrderPage()
    {

        $orders = Order::where('user_id', Auth::id())->where('return_reason', '!=', NULL)->orderBy('id', 'DESC')->get();
        return view('frontend.order.return_order_view', compact('orders'));

    } // End Method 


    public function UserTrackOrder()
    {
        return view('frontend.userdashboard.user_track_order');
    } // End Method 

    public function OrderTracking(Request $request)
    {

        $invoice = $request->code;

        $track = Order::where('invoice_no', $invoice)->first();
        $addressCity = RajaCity::where('city_id', $track->city_id)->first();

        if ($track) {
            return view('frontend.traking.track_order', compact('track', 'addressCity'));

        } else {

            toastr()->error('Kode Invoice Tidak Sesuai!!!');

            return redirect()->back();

        }

    } // End Method 

    public function UserMyRewardPage()
    {
        $id = Auth::user()->id;
        $point = Point::where('user_id', $id)->get('total_poin');
        $userPoint = $point[0]['total_poin'];


        $myRewards = User::with('myReward')
            ->find($id);
        //dd($myRewards[0]);

        $rewardItem = User::select('*')
            ->join('my_rewards', 'users.id', '=', 'my_rewards.user_id')
            ->join('rewards', 'my_rewards.reward_id', '=', 'rewards.id')
            ->where(['users.id' => $id])
            ->get();
        
            //dd($rewardItem);
            // $idItem = ($myRewards->myReward[0]['reward_id']);

        // if ($myRewards == [] OR $rewardItem == []) {
        //     // make message here no results, pass to view
        //     $message = 'data kosong';
        //     return view('frontend.userdashboard.user_myreward_page', compact('message'));
        // } 
            


            return view('frontend.userdashboard.user_myreward_page', compact('userPoint', 'rewardItem'));




    } // End Method 


    public function UserReferralPage()
    {
        $id = Auth::user()->id;
        $point = Point::where('user_id', $id)->get('total_poin');
        $userPoint = $point[0]['total_poin'];

        $referrals = User::with('referralLink')->with('referralRel')
            ->find($id);

        $referralRels = User::select('*')
            ->join('referral_links', 'users.id', '=', 'referral_links.user_id')
            ->join('referral_relationships', 'users.id', '=', 'referral_relationships.user_id')
            ->where(['users.id' => $id])
            ->get();

       // $referralChild = User::where('id', $referralRels->referal_user_id)->get();

        

        $linkReff = $referrals->referralLink->url;
        $linkChild = $referrals->referralRel;

      


        // $referrals = ReferralRelationship::where('user_id', $id)->orderBy('id', 'DESC')->get();
        return view('frontend.userdashboard.user_referral_page', compact('linkReff', 'userPoint', 'linkChild'));
    } // End Method 

    public function SuccessOrder()
    {
        return view('frontend.payment.success_payment');
    } // End Method 

}