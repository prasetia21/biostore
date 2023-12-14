<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\MultiImgReward;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Reward;
use Image;
use Carbon\Carbon;

class RewardController extends Controller
{
    public function AllReward()
    {
        $rewards = Reward::latest()->get();
        return view('backend.reward.reward_all', compact('rewards'));
    } // End Method 


    public function AddReward()
    {
        $vouchers = Voucher::latest()->get();
        // $coupons = Coupon::latest()->get();

        // return view('backend.reward.reward_add', compact('vouchers', 'coupons'));
        return view('backend.reward.reward_add', compact('vouchers'));

    } // End Method 



    public function StoreReward(Request $request)
    {
        $imageThumb = $request->file('reward_thumbnail');
        $name_thumb = hexdec(uniqid()).'.'.$imageThumb->getClientOriginalExtension();
        Image::make($imageThumb)->resize(500,500)->save('upload/rewards/thumbnail/'.$name_thumb);
        $save_url_thumb = 'upload/rewards/thumbnail/'.$name_thumb;

        $reward_id = Reward::create([
            'reward_name' => $request->reward_name,
            'reward_slug' => strtolower(str_replace(' ', '-', $request->reward_name)),
            'reward_desc' => $request->reward_desc,
            'reward_qty' => $request->reward_qty,
            'reward_code' => 'BVR' . '-' . Str::uuid(),
            'reward_rendeem_code' => Str::random(12),
            'rendeem_amount' => $request->rendeem_amount,
            'voucher_id' => $request->voucher_id,
            'coupon_id' => $request->coupon_id,

            'reward_thumbnail' => $save_url_thumb,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        /// Multiple Image Upload From her //////

        $images = $request->file('image_name');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(800, 800)->save('upload/rewards/multi-image/' . $make_name);
            $uploadPath = 'upload/rewards/multi-image/' . $make_name;


            MultiImgReward::insert([

                'reward_id' => $reward_id->id,
                'image_name' => $uploadPath,
                'created_at' => Carbon::now(),

            ]);
        } // end foreach

        /// End Multiple Image Upload From her //////

        toastr()->info('Reward Berhasil Ditambahkan');

        return redirect()->route('all.reward');

    } // End Method 



    public function EditReward($id)
    {
        $multiImgs = MultiImgReward::where('reward_id', $id)->get();
        $reward = Reward::findOrFail($id);
        return view('backend.reward.reward_edit', compact('rewards'. 'multiImgs'));
    } // End Method 


    public function UpdateReward(Request $request)
    {

        $reward_id = $request->id;

        Reward::findOrFail($reward_id)->update([
            'reward_name' => $request->reward_name,
            'reward_slug' => strtolower(str_replace(' ', '-', $request->reward_name)),
            'reward_desc' => $request->reward_desc,
            'rendeem_amount' => $request->rendeem_amount,
            'voucher_id' => $request->voucher_id,
            'coupon_id' => $request->coupon_id,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);


        toastr()->success('Reward Berhasil Diupdate');

        return redirect()->route('all.reward');

    } // End Method 

    public function UpdateRewardThumbnail(Request $request)
    {

        $pro_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('reward_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(500, 500)->save('upload/rewards/thumbnail/' . $name_gen);
        $save_url = 'upload/rewards/thumbnail/' . $name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Reward::findOrFail($pro_id)->update([

            'reward_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        toastr()->success('Gambar Muka Reward Berhasil Diupdate');
        

        return redirect()->back();


    } // End Method 

    public function UpdateRewardMultiimage(Request $request)
    {

        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImgReward::findOrFail($id);
            unlink($imgDel->image_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(800, 800)->save('upload/rewards/multi-image/' . $make_name);
            $uploadPath = 'upload/rewards/multi-image/' . $make_name;

            MultiImgReward::where('id', $id)->update([
                'image_name' => $uploadPath,
                'updated_at' => Carbon::now(),

            ]);
        } // end foreach

        toastr()->success('Reward Bergambar Berhasil Diupdate');

        return redirect()->back();

    } // End Method 

    public function MulitImageDelelte($id)
    {
        $oldImg = MultiImgReward::findOrFail($id);
        unlink($oldImg->photo_name);

        MultiImgReward::findOrFail($id)->delete();

        toastr()->success('Reward Bergambar Berhasil Dihapus');

        return redirect()->back();

    } // End Method 

    public function RewardInactive($id)
    {

        Reward::findOrFail($id)->update(['status' => 0]);
        
        toastr()->success('Reward Berhasil Dinon-Aktifkan');

        return redirect()->back();

    } // End Method 


    public function RewardActive($id)
    {

        Reward::findOrFail($id)->update(['status' => 1]);
        
        toastr()->success('Reward Berhasil Diaktifkan');

        return redirect()->back();

    } // End Method 

    public function DeleteReward($id)
    {
        $reward = Reward::findOrFail($id);
        unlink($reward->reward_thumbnail);
        unlink($reward->reward_image);
        Reward::findOrFail($id)->delete();

        toastr()->success('Reward Berhasil Dihapus');

        return redirect()->back();

    } // End Method 
}
