<!DOCTYPE html>
<html class="no-js" lang="en">

@php
    $seo = App\Models\Seo::find(1);
@endphp

<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="title" content="{{ $seo->meta_title }}" />
    <meta name="author" content="{{ $seo->meta_author }}" />
    <meta name="keywords" content="{{ $seo->meta_keyword }}" />
    <meta name="description" content="{{ $seo->meta_description }}" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />

    {{-- New Template --}}

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('frontend/new/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/slick.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/new/css/media-query.css') }}" />

    <!-- Toaster -->
        
        
    <!-- Toaster   -->

    <style>
        .referral-code input[type="text"] {
            display: none;
        }
    </style>

    <script>
        function reffCheck() {
            let checkBox = document.getElementById("referralCodeChecked");
            let text = document.getElementById("referralCode");
            if (checkBox.checked === true) {
                text.style.display = "block";
            } else {
                text.style.display = "none";
            }
        }
    </script>
</head>

<body>
    <main class="main pages">
        <div class="page-content pt-20 pb-40">
            <div class="container">
                <div class="row">
                    <div class="m-auto">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-3">Buat Akun Baru</h1>
                                            <p class="mb-20">Sudah punya akun? <a
                                                    href="{{ route('login') }}">Login</a></p>
                                        </div>


                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf


                                            <div class="form-group">
                                                <input type="text" id="name" required="" name="name"
                                                    placeholder="Username" />
                                            </div>
                                            <div class="form-group">
                                                <input type="email" id="email" required="" name="email"
                                                    placeholder="Email" />
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="referralCodeChecked" onclick="reffCheck()">
                                                <label class="form-check-label" for="referralCodeChecked">
                                                    Punya Kode Referall (Optional)
                                                </label>
                                            </div>

                                            <div class="form-group referral-code">
                                                <input id="referralCode" type="text" name="referral_code"
                                                    placeholder="Referral Code (Optional)" />
                                            </div>


                                            <div class="form-group">
                                                <input required="" id="password" type="password" name="password"
                                                    placeholder="Password" />
                                            </div>



                                            <div class="form-group">
                                                <input required="" id="password_confirmation" type="password"
                                                    name="password_confirmation" placeholder="Confirm password" />
                                            </div>


                                            <div class="login_footer form-group mb-20">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="checkbox" id="exampleCheckbox12" value="" />
                                                        <label class="form-check-label"
                                                            for="exampleCheckbox12"><span>Saya
                                                                Setuju dengan &amp; Syarat dan Ketentuan.</span></label>
                                                    </div>
                                                </div>
                                                {{-- <a href="page-privacy-policy.html"><i
                                                        class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a> --}}
                                            </div>
                                            <div class="form-group d-grid gap-2 mb-20">
                                                <button type="submit"
                                                    class="btn btn-fill-out btn-block hover-up font-weight-bold"
                                                    name="login">Daftar</button>
                                            </div>
                                            {{-- <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will
                                                be used to support your experience throughout this website, to manage
                                                access to your account, and for other purposes described in our privacy
                                                policy</p> --}}
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    @include('auth.footer')
