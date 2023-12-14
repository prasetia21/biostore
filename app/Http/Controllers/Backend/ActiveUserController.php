<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Point;

class ActiveUserController extends Controller
{
    public function AllUser(){
        $id = Auth::user()->id;
        $users = User::where('role','user')->latest()->get();
        // $userPoint = Point::with('user')->latest()->get();

        $userPoint = User::select('users.*','points.total_poin')
        ->join('points','users.id','=','points.user_id')
        ->where(['users.role' => 'user'])
        ->get();

        return view('backend.user.user_all_data',compact('users', 'userPoint'));

    } // End Mehtod 

    public function AllVendor(){
        $vendors = User::where('role','vendor')->latest()->get();
        return view('backend.user.vendor_all_data',compact('vendors'));

    } // End Mehtod 



} 
