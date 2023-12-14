@php
    $route = Route::current()->getName();
@endphp

@extends('dashboard')
@section('user')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> My Account
            </div>
        </div>
    </div>

    <section id="profile-page-sec">
        <div class="profile-top-sec">
            <div class="profile-top-sec-full">
                <h1 class="d-none">Profile</h1>
                <h2 class="d-none">ProfilePage</h2>
                <div class="profile-img-sec">
                    <img id="showImage"
                        src="{{ !empty($userData->photo) ? url('upload/user_images/' . $userData->photo) : url('upload/no_image.jpg') }}"
                        alt="User" class="rounded-circle p-1 bg-primary" width="110">
                </div>

                <div class="profile-details-sec">
                    <h3 class="pro-txt1">{{ Auth::user()->name }}</h3>
                    <a href="mailto:{{ $userData->email }}">
                        <h4 class="pro-txt2">{{ $userData->email }}</h4>
                    </a>
                    <a href="tel:{{ !empty($userData->phone) ? $userData->phone : '-' }}">
                        <h5 class="pro-txt3">{{ !empty($userData->phone) ? $userData->phone : '-' }}</h5>
                    </a>
                </div>
                <div class="profile-btn-sec">
                    <a href="{{ route('user.profile.page') }}">Edit Profile <span><img
                                src="http://localhost:8000/frontend/new/images/homepage/see-all-icon.svg"
                                alt="right-arrow"></span></a>
                </div>
            </div>
        </div>

        <br />
        <div id="profile-second-sec mt-16">
            @include('frontend.body.dashboard_widgetbar_menu')
        </div>

        <br />

        <div class="col-md-12">
            <div class="dashboard-menu">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0">Alamat:</h5>
                            {!! empty($userAddress[0]->address) ? '<a href="/user/address/add">Tambah<i class="fi-rs-plus-small ml-5"></i></a>' : '<a href="/user/address/editpage">Edit<i class="fi-rs-pencil ml-5"></i></a>' !!}
                        </div>
                        <div class="mx-auto"> 
                            <h5 class="prile3-txt3">{{ !empty($userAddress[0]->address) ? $userAddress[0]->address : '-' }}</h5>
                            {!!  empty($userAddress[0]->address) ? '<span class="badge bg-danger badge-custom">Segera Lengkapi Detail Alamat Pengiriman Anda untuk Melanjutkan Berbelanja</span>' : '<span class="badge bg-warning text-dark">Alamat Utama Anda</span>' !!}
                        </div>                                          
                    </div>

                </div>
            </div>
        </div>

       
        @include('frontend.body.dashboard_navigation_menu')

    </section>
@endsection
