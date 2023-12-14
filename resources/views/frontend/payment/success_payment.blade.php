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
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
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
</head>

<body>
    <div class="site_content">
        <!-- Modal -->

        <!-- Quick view -->
        @include('frontend.body.quickview')
        <!-- Header  -->

        @include('frontend.body.header')
        <!--End header-->

        <!-- Search  -->


        <div class="alert alert-success mt-60" role="alert">
            <h4 class="alert-heading mb-10">Pembayaran Berhasil!</h4>
            <p>Segera Cek Pemberitahuan pada Email Anda untuk Melihat Detail Pemesanan.</p>
            <p>Harap Simpan Baik-baik Nomor Invoice, No. Invoice dapat Anda Gunakan untuk Melakukkan Tracking Pemesanan
                di Halaman Order Tracking</p>
            <hr>
            <p class="mb-0"><a href="{{ route('user.track.order.guest') }}">Klik disini</a> untuk menuju halaman
                Order Tracking</p>
            <hr>
            <p class="mb-10">Jika Anda Masih Kesulitan Anda dapat Menghubungi Customer Service Kami di Nomor Dibawah
                ini.</p>
            <a href="#" class="badge rounded-pill bg-danger">Customer Service 1</a>
            <a href="#" class="badge rounded-pill bg-warning">Customer Service 2</a>
            <a href="#" class="badge rounded-pill bg-info">Customer Service 3</a>

        </div>

        @include('frontend.body.footer')



        <!-- Preloader Start -->
        <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="text-center">
                        <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- NEW Template JS --}}
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/new/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/new/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/new/js/custom.js') }}"></script>



    <!-- Vendor JS-->
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>

    {{-- <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script> --}}
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>

        

    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>



</body>

</html>
