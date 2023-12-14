@include('auth.head')

<body>
    @include('frontend.body.header')
    <div class="verify_content mt-60">
        <div class="card-body">
            <div class="text-center">
                <x-slot name="logo">
                    <a href="/">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="215" height="215" xml:space="preserve" version="1.1" viewBox="0 0 215 215">
                            <image width="215" height="215" xlink:href="data:image/png;base64,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"/>
                          </svg>
                    </a>
                </x-slot>
            </div>

            <div class="mb-4 text-sm text-gray-600">
                <p>Terima kasih telah mendaftar!
               Kami Telah Mengirimkan Link Verifikasi untuk Menyelesaikan Pendaftaran Anda,?
            Bila Anda belum menerima email, klik permintaan verifikasi ulang di link dibawah ini.</p>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('Link Verifikasi yang baru telah kami kirimkan.') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <p> </p>

                <div class="mt-4 btn-verify">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf

                        <div>
                            <x-button>
                                {{ __('Resend Verification Email') }}
                            </x-button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <div>
                            <x-button>
                                {{ __('Log Out') }}
                            </x-button>
                        </div>

                    </form>
                </div>
        </div>
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
        <!-- Vendor JS-->
       <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
        <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
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
    
               
    
    <script>
     @if(Session::has('message'))
     var type = "{{ Session::get('alert-type','info') }}"
     switch(type){
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

