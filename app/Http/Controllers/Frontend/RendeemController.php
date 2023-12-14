<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\MyReward;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Reward;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;

class RendeemController extends Controller
{

    public function MyReward()
    {

        return view('frontend.myreward.view_myreward');

    } // End Method


    public function addToRendeemReward(Request $request)
    {
        $id = $request->id;
        $user_id = $request->user_id;
        
        //$userData = User::find($user_id);
        $reward = Reward::findOrFail($id);
        $point = Point::where('user_id', $user_id)->get();

        $userPoint = intval($point[0]['total_poin']);
        $rendeemPoint = intval($request->rendeem_amount);

        $qtyReward = intval($reward->reward_qty);
        $rendeemReq = intval($request->quantity);
        //dd($rendeemPoint);

        $usePoint = $userPoint - $rendeemPoint;
        $stockReward = $qtyReward - $rendeemReq;
        $totalPointReward = $rendeemPoint * $rendeemReq;

        if ($totalPointReward > $userPoint) {
           
            toastr()->warning('Poin Tidak Cukup!!!');
            return redirect()->back();
        } else {

            $reward_id = MyReward::create([
                'reward_id' => $reward->id,
                'user_id' => $user_id,
                'point_use' => $request->rendeem_amount,
                'quantity' => $request->reward_qty,
                'created_at' => Carbon::now(),
            ]);

            $pointUpdate = Point::where('user_id', $user_id)->update(['total_poin' => $usePoint]);
            $rewardQtyUpdate = Reward::where('id', $id)->update(['reward_qty' => $stockReward]);
            //dd($user_id);
           
           

            toastr()->success('Reward Berhasil Ditambahkan di Akun Anda!!!');
            return redirect()->intended('/reward/details/'.$reward->reward_slug.'-'.$reward->id.'.html');
        }

        

        // $notification = array(
        //     'message' => 'Item added successfully!',
        //     'alert-type' => 'success'
        // );
    
        //return redirect()->intended('/reward/details/'.$reward->reward_slug.'-'.$reward->id.'.html');

        // return response()->json(['success' => 'Successfully Added']);
        //return redirect('/reward/details/'.$reward->reward_slug.'-'.$reward->id.'.html')->with('success', 'Item added successfully!');


    } // End Method
}