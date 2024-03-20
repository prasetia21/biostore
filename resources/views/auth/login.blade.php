@section('title')
    Halaman Login
@endsection

@include('auth.head')

<body>
    <div class="site_content">
        <!-- SignIn Details  Start -->
        <section id="sign-in-screen">
            <div class="container">
                <div class="sign-in-screen_full">
                    <div class="sign-in-screen-top mb-50">
                        <h1>Selamat Datang!</h1>
                        <p class="sign-in-cont">Masuk untuk Melanjutkan</p>
                        <form class="sign-in-form mt-32" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-sec">
                                <label class="txt-lbl">Email</label><br>
                                <input type="email" id="email" required="" name="email"
                                    placeholder="example@gmail.com *" class="txt-input">
                                <div class="form_bottom_boder"></div>
                            </div>
                            <div class="form-sec mt-16">
                                <label class="txt-lbl">Password</label><br>
                                <input required="" id="password" type="password" name="password"
                                    placeholder="***********" class="txt-input">
                                <div class="form_bottom_boder"></div>
                            </div>

                            <div class="row remember-sec">
                                {{-- <div class="col-6">
                                <span><img src="{{ asset('frontend/new/images/sign-in-screen/remember.svg') }}" alt="remeber-icon"></span>
                                <a href="javascript:void(0)" class="remember-btn">Ingat Saya</a>
                            </div> --}}
                                <div class="col-12 d-flex justify-content-end align-items-center">
                                    <a href="{{ route('password.request') }}" class="forget-btn">Lupa Password?</a>
                                </div>
                            </div>
                            <div class="sign-in mt-32">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-block hover-up" name="login">Log
                                        in</button>
                                </div>
                            </div>
                        </form>
                        {{-- <div class="or_sign mt-32">
                            <p>Atau Masuk dengan...</p>
                        </div>
                        <div class="social_media mt-32">
                            <div class="icon-box">
                                <a href="https://www.google.com/" target="_blank"><img
                                        src="{{ asset('frontend/new/images/sign-in-screen/google.png') }}"
                                        alt="google-img"></a>
                            </div>
                            <div class="icon-box">
                                <a href="https://www.facebook.com/" target="_blank"><img
                                        src="{{ asset('frontend/new/images/sign-in-screen/facebook.png') }}"
                                        alt="facebook-img"></a>
                            </div>

                        </div> --}}
                        <div class="block-footer">
                            <p>Belum punya akun? <a href="{{ route('register') }}">Sign Up</a></p>
                        </div>

                        <div class="social_media or_sign mt-15">
                            <a href="{{ route('home.guest') }}"><img src="{{ asset('frontend/new/images/sign-in-screen/shopping-cart.png') }}"
                                alt="cart-img" style="width: 40px">
                            <p>Atau Belanja tanpa akun</p></a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- SignIn Details  End -->
    </div>


    @include('auth.footer')
