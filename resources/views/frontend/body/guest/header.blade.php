<header id="top-navbar" class="top-navbar">
    <div class="container">
        <div class="top-navbar_full">
            @php
                $setting = App\Models\SiteSetting::find(1);
            @endphp

            <div class="header-action-icon-2 d-block">
                <div class="burger-icon burger-icon-white">
                    <span class="burger-icon-top"></span>
                    <span class="burger-icon-mid"></span>
                    <span class="burger-icon-bottom"></span>
                </div>
            </div>

            <div class="brookwood-txt d-flex align-items-center">
                <a href="{{ url('/guest/') }}"><img class="logo-header" src="{{ asset($setting->logo) }}"
                        alt="logo" /></a>
            </div>
            <div>
                <ul class="homepage-cart-sec">
                    <div class="header-action-right">
                        <div class="header-action-2">

                            <li class="pf-16">
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{ route('mycart.guest') }}">
                                        <img alt="Nest"
                                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                        <span class="pro-count blue" id="cartQty">0</span>
                                    </a>
                                    <a href="{{ route('mycart.guest') }}"></a>
                                    <div class="cart-dropdown-wrap cart-dropdown-hm2">


                                        <!--   // mini cart start with ajax -->
                                        <div id="miniCart">

                                        </div>

                                        <!--   // End mini cart start with ajax -->

                                        <div class="shopping-cart-footer">
                                            <div class="shopping-cart-total">
                                                <h4>Total <span id="cartSubTotal"> </span></h4>
                                            </div>
                                            <div class="shopping-cart-button">
                                                <a href="{{ route('mycart.guest') }}" class="outline">View cart</a>
                                                <a href="{{ route('checkout.guest') }}">Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <div class="navbar-boder"></div>
</header>


<script>
    function search_result_show() {
        $("#searchProducts").slideDown();

    }

    function search_result_hide() {
        $("#searchProducts").slideUp();
    }
</script>

<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ url('/guest/') }}"><img class="logo-header"
                        src="{{ asset('frontend/assets/imgs/theme/logo.png') }}" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{ route('product.search.guest') }}" method="post">
                    @csrf
                    <input onfocus="search_result_show()" onblur="search_result_hide()" name="search" id="search"
                        type="text" placeholder="Search Products" class="form-control search-text">
                    <div id="searchProducts"></div>
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="{{ url('/guest/') }}">Home</a>

                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ route('shop.page.guest') }}">Shop</a>
                        </li>

                        <li class="menu-item-has-children">
                            <a href="https://biovarnish.com/category/tips/" target="_blank" rel="noopener">Blog</a>

                        </li>



                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwi74tq20e2CAxXmT2wGHQEpC_UQ9Rd6BAhUEAQ&url=%2Fmaps%2Fdir%2F%2Fbioindustries%2Fdata%3D!4m6!4m5!1m1!4e2!1m2!1m1!1s0x2e7a570f4f3e0b1d%3A0xcea895e709d8f3e9%3Fsa%3DX%26ved%3D2ahUKEwi74tq20e2CAxXmT2wGHQEpC_UQ9Rd6BAhOEAA&usg=AOvVaw0XlLVIWvd1ASxZSODJ6PCO&opi=89978449"
                        target="_blank" rel="noopener nofollow noreferer"><i class="fi-rs-marker"></i> Store Kami </a>
                </div>
                <div class="single-mobile-header-info">

                    @auth
                        <a href="{{ route('dashboard') }}"><i class="fi-rs-user"></i>Dashboard</a>
                        <br />
                        <a href="{{ route('user.logout') }}"><i class="fi-rs-sign-out"></i>Logout</a>
                    @endauth

                    @guest
                        <a href="{{ route('login') }}"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                    @endguest

                </div>
                <br /><br />
                <div class="single-mobile-header-info">
                    <h6>Kontak Kami</h6>
                </div>
                <div class="single-mobile-header-info">
                    <a href="https://bit.ly/CSBiovarnish1"><i class="fi-rs-headphones"></i> 0821-6760-0693 </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="https://bit.ly/CSBiovarnish2"><i class="fi-rs-headphones"></i> 0821-3720-3007 </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="https://bit.ly/CSBiovarnish3"><i class="fi-rs-headphones"></i> 0895-3231-04338</a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="https://id-id.facebook.com/biovarnish/" target="_blank"
                    rel="noopener nofollow noreferer"><img
                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                        alt="" /></a>
                <a href="https://www.instagram.com/biovarnish/" target="_blank"
                    rel="noopener nofollow noreferer"><img
                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                        alt="" /></a>
                <a href="https://www.youtube.com/channel/UCLlPdr6osQD3eUWbLQDJJzQ" target="_blank"
                    rel="noopener nofollow noreferer"><img
                        src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                        alt="" /></a>
            </div>
            <div class="site-copyright">Copyright 2023 © BV. All rights reserved. Powered by Bioindustries.</div>
        </div>
    </div>
</div>
