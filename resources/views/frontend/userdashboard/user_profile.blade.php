@extends('dashboard')
@section('user')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Profile
            </div>
        </div>
    </div>

    <section id="profile-page-sec">
        <div class="page-content pt-20 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="tab-content account dashboard-content">
                                    <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                        aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5>Edit Profile</h5>
                                            </div>
                                            <div class="card-body">



                                                <form method="post" action="{{ route('user.profile.store') }}" enctype="multipart/form-data" >
                                                    @csrf

                                                    @if (session('status'))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ session('status') }}
                                                        </div>
                                                    @elseif(session('error'))
                                                        <div class="alert alert-danger" role="alert">
                                                            {{ session('error') }}
                                                        </div>
                                                    @endif


                                                    <div class="row">

                                                        <div class="form-group col-md-12">
                                                            <label>  <span class="required">*</span></label>
                                                            <img id="showImage" src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo):url('upload/no_image.jpg') }}" alt="User" class="rounded-circle p-1 bg-primary" width="110">
                                                        </div>
                                                        <div class="form-group col-md-12">
                                                            <label>Ubah Avatar Profile</label>
                                                            <input class="form-control" name="photo" type="file"  id="image" />
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>Nama Lengkap<span class="required">*</span></label>
                                                            <input
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name" type="text" id="name" value="{{ $userData->name }}"
                                                                />

                                                            @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>Username<span class="required">*</span></label>
                                                            <input
                                                                class="form-control @error('username') is-invalid @enderror"
                                                                name="username" type="text" id="username" value="{{ $userData->username }}"
                                                                />

                                                            @error('username')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>Email <span class="required">*</span></label>
                                                            <input
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" type="email" id="email" value="{{ $userData->email }}"
                                                                readonly />

                                                            @error('email')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group col-md-12">
                                                            <label>No Telp / WA</label>
                                                            <input
                                                                class="form-control @error('phone') is-invalid @enderror"
                                                                name="phone" type="number" id="phone" value="{{ $userData->phone }}"
                                                                placeholder="Masukkan No Telp / WA Aktif"/>

                                                            @error('phone')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                        <div class="form-group col-md-12">
                                                            <label>Alamat Lengkap</label>
                                                            <input class="form-control" name="address"
                                                                type="text" id="address" value="{{ $userData->address }}"
                                                                placeholder="Masukkan Alamat Lengkap" />

                                                        </div>



                                                        <div class="col-md-12">
                                                            <button type="submit"
                                                                class="btn btn-fill-out submit font-weight-bold"
                                                                name="submit" value="Submit">Simpan Perubahan</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('frontend.body.dashboard_navigation_menu')
    </section>
@endsection
