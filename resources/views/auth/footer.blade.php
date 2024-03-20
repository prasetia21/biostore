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
        {{-- <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script> --}}
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