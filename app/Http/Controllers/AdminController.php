<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Notifications\VendorApproveNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function AdminDashboard()
    {

        return view('admin.index');

    } // End Mehtod 


    public function AdminLogin()
    {
        return view('admin.admin_login');
    } // End Mehtod 


    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } // End Mehtod 


    public function AdminProfile()
    {

        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));

    } // End Mehtod 

    public function AdminProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        toastr()->success('Profil Berhasil Diubah');

        return redirect()->back();

    } // End Mehtod 


    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    } // End Mehtod 


    public function AdminUpdatePassword(Request $request)
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

        toastr()->success('Kata Sandi berhasil diubah');

        return back()->with("status", " Kata Sandi berhasil diubah");

    } // End Mehtod 



    public function InactiveVendor()
    {
        $inActiveVendor = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor', compact('inActiveVendor'));

    } // End Mehtod 


    public function ActiveVendor()
    {
        $ActiveVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.active_vendor', compact('ActiveVendor'));

    } // End Mehtod 


    public function InactiveVendorDetails($id)
    {

        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details', compact('inactiveVendorDetails'));

    } // End Mehtod 


    public function ActiveVendorApprove(Request $request)
    {

        $verdor_id = $request->id;
        $user = User::findOrFail($verdor_id)->update([
            'status' => 'active',
        ]);

       

        toastr()->success('Vendor Berhasil Diaktifkan');

        $vuser = User::where('role', 'vendor')->get();
        Notification::send($vuser, new VendorApproveNotification($request));
        return redirect()->route('active.vendor');

    } // End Mehtod 


    public function ActiveVendorDetails($id)
    {

        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details', compact('activeVendorDetails'));

    } // End Mehtod 


    public function InActiveVendorApprove(Request $request)
    {

        $verdor_id = $request->id;
        $user = User::findOrFail($verdor_id)->update([
            'status' => 'inactive',
        ]);


        toastr()->success('Vendor Berhasil Dinon-Aktifkan');

        return redirect()->route('inactive.vendor');

    } // End Mehtod 


    ///////////// Admin All Method //////////////


    public function AllAdmin()
    {
        $alladminuser = User::where('role', 'admin')->latest()->get();
        return view('backend.admin.all_admin', compact('alladminuser'));
    } // End Mehtod 


    public function AddAdmin()
    {
        $roles = Role::all();
        return view('backend.admin.add_admin', compact('roles'));
    } // End Mehtod 



    public function AdminUserStore(Request $request)
    {

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        

        toastr()->success('Admin baru berhasil ditambahkan');

        return redirect()->route('all.admin');

    } // End Mehtod 




    public function EditAdminRole($id)
    {

        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.admin.edit_admin', compact('user', 'roles'));
    } // End Mehtod 


    public function AdminUserUpdate(Request $request, $id)
    {


        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }


        toastr()->success('Admin berhasil diubah');

        return redirect()->route('all.admin');

    } // End Mehtod 


    public function DeleteAdminRole($id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }


        toastr()->success('Admin berhasil dihapus');

        return redirect()->back();

    } // End Mehtod 
}