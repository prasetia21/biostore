<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Point;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function UserDashboard()
    {

        $id = Auth::user()->id;
        $userData = User::find($id);
        $userAddress = ShippingAddress::where('user_id', $id)->get();
        $point = Point::where('user_id', $id)->get('total_poin');
        $userPoint = $point[0]['total_poin'];

        return view('index', compact('userData', 'userPoint', 'userAddress'));
    } // End Method 

    public function UserProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        // $data->address = $request->address;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();


        toastr()->success('Profil User Berhasil Diubah');

        return redirect()->back();
    } // End Mehtod 

    public function UserAddressStore(Request $request)
    {

        ShippingAddress::insert([
            'user_id' => $request->user_id,
            'raja_province_id' => $request->province_destination,
            'city_id' => $request->city_destination,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'note' => $request->note,
            'status' => $request->status,
        ]);

        toastr()->success('Alamat Berhasil Ditambahkan');

        return redirect()->route('dashboard');
    } // End Mehtod 

    public function UserAddressEdit(Request $request)
    {

        $id = Auth::user()->id;
        $ida = ShippingAddress::where('user_id', $id)->first();
        $data = ShippingAddress::find($ida->id);


        $data->phone = $request->phone;
        $data->raja_province_id = $request->province_destination;
        $data->city_id = $request->city_destination;
        $data->address = $request->address;
        $data->post_code = $request->post_code;
        $data->note = $request->note;

        $data->save();



        toastr()->success('Alamat Berhasil Diubah');

        return redirect()->route('dashboard');
    } // End Mehtod 


    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        toastr()->success('Logout Sukses');

        return redirect('/');
    } // End Mehtod 


    public function UserUpdatePassword(Request $request)
    {
        // Validation 
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match The Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Kata Sandi Tidak Sesuai, Cek Kembali Kata Sandi Lama Anda!!");
        }

        // Update The new password 
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        toastr()->success('Kata Sandi Berhasil Diubah');

        return back()->with("status", " Kata Sandi Berhasil Diubah");
    } // End Mehtod 
}
