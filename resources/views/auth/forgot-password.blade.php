@include('auth.head')

<body>

    <!-- Quick view -->
    @include('frontend.body.header')
    <!--End header-->

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Lupa Password
                </div>
            </div>
        </div>
        <div class="page-content pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="m-auto">
                        <div class="row">
                            <div class="heading_s1">
                                <img class="border-radius-15"
                                    src="{{ asset('frontend/assets/imgs/page/reset_password.svg') }}" alt="" />
                                <h2 class="mb-15 mt-15">Email Password Reset</h2>
                                <p class="mb-30">Lupa password anda? Jangan Khawatir. Cukup beri tahu kami alamat email Anda
                                    dan kami akan mengirimi Anda email berisi tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.
                                </p>
                            </div>
                            <div class="col-lg-12">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">

                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" id="email" required="" name="email"
                                                    placeholder="Email *" />
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up"
                                                    name="login">Email Password Reset Link</button>
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
    </main>

    

    @include('auth.footer')
