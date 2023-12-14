@extends('frontend.master_dashboard')
@section('main')

@section('title')
    {{ $product->product_name }}
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> <a
                href="{{ url('product/category/' . $product['category']['category_slug'] . '-' . $product['category']['id'] . '.html') }}">{{ $product['category']['category_name'] }}</a>
            <span></span> {{ $product['subcategory']['subcategory_name'] }} <span></span>{{ $product->product_name }}
        </div>
    </div>
</div>

<section id="single-prduct-page">
    <div class="product-page2-first-sec">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators productpage2-custom-indicator">
                @foreach ($multiImage as $key => $img)
                    <button type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }} custom-dots"
                        aria-current="true"></button>
                @endforeach
            </div>
            <div class="carousel-inner">

                @foreach ($multiImage as $key => $img)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">

                        <div class="product-page2-slider">
                            <div class="productpage2-overlay"></div>
                            <img src="{{ asset($img->photo_name) }}" alt="product-img" class="img-fluid w-100">
                            <div class="product-page2-top">
                                <div class="prod-page2-sofas">
                                    <p>{{ $product['category']['category_name'] }}</p>
                                </div>
                                <div class="prod-page2-favour">
                                    <a href="javascript:void(0);" class="item-bookmark">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <mask style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                                width="20" height="20">
                                                <rect width="20" height="20" fill="white"></rect>
                                            </mask>
                                            <g mask="url(#mask0_1_2980)">
                                                <path
                                                    d="M13.4259 2.5C16.3611 2.5 18.3333 5.29375 18.3333 7.9C18.3333 13.1781 10.1481 17.5 9.99996 17.5C9.85181 17.5 1.66663 13.1781 1.66663 7.9C1.66663 5.29375 3.63885 2.5 6.57403 2.5C8.25922 2.5 9.36107 3.35312 9.99996 4.10312C10.6388 3.35312 11.7407 2.5 13.4259 2.5Z"
                                                    fill="#666666"></path>
                                            </g>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="product-page2-bottom">
                                <div class="product-page2-bottom-wrapper">
                                    <h1 class="prod-page2-title" id="product_dname">{{ $product->product_name }}</h1>
                                    <p class="prod-page2-subtitle"> @price($product->selling_price)</p>
                                    <div class="product-page2-rating mt-12">
                                        <input type="hidden" value="{{ $product->id }}" id="product_did">
                                        <ul>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page2/yellow-star.svg') }}"
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page2/yellow-star.svg') }}"
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page2/yellow-star.svg') }}"
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page2/yellow-star.svg') }}"
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page2/light-yellow-star.svg') }}"
                                                    alt="yellow-star"></li>
                                            <li class="pf-8 rate-txt-prod">(45)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="product-page2-second-sec mt-16">
        <div class="product-page2-second-sec-wrapper">
            <h2 class="d-none">Product Detail</h2>
            <p class="read-less-text read-desc">{{ $product->short_desc }}
                <span class="read_dots" style="">...</span>
            </p>
            <p class="read-more-text read-desc">{{ $product->long_desc }}</p>
            <div class="read-more-btn-text">
                <a href="javascript:void(0);" class="product2-readmore">

                    <img src="{{ asset('frontend/new/images/single-product-page2/read-more-arrow.svg') }}"
                        alt="right-arrow">
                    <p class="read-more">Read More</p>
                </a>
            </div>
        </div>
    </div>

    <div class="product-page1-eight-sec mt-24">
        <div class="container">
            <h3 class="share-txt">Share</h3>
            <div class="social-share-sec-full">
                <div class="social-share">
                    <a href="https://www.facebook.com/" target="_blank">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_1_3093" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="24" height="24">
                                <path d="M0 0H24V24H0V0Z" fill="white" />
                            </mask>
                            <g mask="url(#mask0_1_3093)">
                                <path
                                    d="M14 13.5H16.5L17.5 9.5H14V7.5C14 6.47 14 5.5 16 5.5H17.5V2.14C17.174 2.097 15.943 2 14.643 2C11.928 2 10 3.657 10 6.7V9.5H7V13.5H10V22H14V13.5Z"
                                    fill="#0EA5E9" />
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="social-share bg-blue">
                    <a href="https://web.whatsapp.com/" target="_blank">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_1_3088" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="24" height="24">
                                <path d="M0 0H24V24H0V0Z" fill="white" />
                            </mask>
                            <g mask="url(#mask0_1_3088)">
                                <path
                                    d="M2.00401 22L3.35601 17.032C2.46515 15.5049 1.99711 13.768 2.00001 12C2.00001 6.477 6.47701 2 12 2C17.523 2 22 6.477 22 12C22 17.523 17.523 22 12 22C10.2328 22.0029 8.49667 21.5352 6.97001 20.645L2.00401 22ZM8.39101 7.308C8.26188 7.31602 8.13569 7.35003 8.02001 7.408C7.91153 7.46943 7.81251 7.54622 7.72601 7.636C7.60601 7.749 7.53801 7.847 7.46501 7.942C7.09542 8.423 6.89662 9.01342 6.90001 9.62C6.90201 10.11 7.03001 10.587 7.23001 11.033C7.63901 11.935 8.31201 12.89 9.20101 13.775C9.41501 13.988 9.62401 14.202 9.84901 14.401C10.9524 15.3725 12.2673 16.073 13.689 16.447L14.258 16.534C14.443 16.544 14.628 16.53 14.814 16.521C15.1053 16.506 15.3896 16.4271 15.647 16.29C15.813 16.202 15.891 16.158 16.03 16.07C16.03 16.07 16.073 16.042 16.155 15.98C16.29 15.88 16.373 15.809 16.485 15.692C16.568 15.606 16.64 15.505 16.695 15.39C16.773 15.227 16.851 14.916 16.883 14.657C16.907 14.459 16.9 14.351 16.897 14.284C16.893 14.177 16.804 14.066 16.707 14.019L16.125 13.758C16.125 13.758 15.255 13.379 14.724 13.137C14.668 13.1126 14.608 13.0987 14.547 13.096C14.4786 13.089 14.4095 13.0967 14.3443 13.1186C14.2791 13.1405 14.2193 13.1761 14.169 13.223V13.221C14.164 13.221 14.097 13.278 13.374 14.154C13.3325 14.2098 13.2754 14.2519 13.2098 14.2751C13.1443 14.2982 13.0733 14.3013 13.006 14.284C12.9409 14.2666 12.877 14.2445 12.815 14.218C12.691 14.166 12.648 14.146 12.563 14.109L12.558 14.107C11.9859 13.8572 11.4562 13.5198 10.988 13.107C10.862 12.997 10.745 12.877 10.625 12.761C10.2316 12.3842 9.88873 11.958 9.60501 11.493L9.54601 11.398C9.50364 11.3342 9.46937 11.2653 9.44401 11.193C9.40601 11.046 9.50501 10.928 9.50501 10.928C9.50501 10.928 9.74801 10.662 9.86101 10.518C9.9551 10.3983 10.0429 10.2738 10.124 10.145C10.242 9.955 10.279 9.76 10.217 9.609C9.93701 8.925 9.64701 8.244 9.34901 7.568C9.29001 7.434 9.11501 7.338 8.95601 7.319C8.90201 7.313 8.84801 7.307 8.79401 7.303C8.65972 7.29633 8.52515 7.29766 8.39101 7.307V7.308Z"
                                    fill="white" />
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="social-share">
                    <a href="https://twitter.com/" target="_blank">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_1_3083" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="24" height="24">
                                <path d="M0 0H24V24H0V0Z" fill="white" />
                            </mask>
                            <g mask="url(#mask0_1_3083)">
                                <path
                                    d="M22.1621 5.656C21.3986 5.9937 20.589 6.21548 19.7601 6.314C20.6338 5.79144 21.2878 4.96902 21.6001 4C20.7801 4.488 19.8811 4.83 18.9441 5.015C18.3147 4.34158 17.4804 3.89497 16.571 3.74459C15.6616 3.59421 14.728 3.74849 13.9153 4.18346C13.1026 4.61842 12.4564 5.30969 12.0772 6.1498C11.6979 6.9899 11.6068 7.93178 11.8181 8.829C10.1552 8.74566 8.52838 8.31353 7.04334 7.56067C5.55829 6.80781 4.24818 5.75105 3.19805 4.459C2.82634 5.09745 2.63101 5.82323 2.63205 6.562C2.63205 8.012 3.37005 9.293 4.49205 10.043C3.82806 10.0221 3.17869 9.84278 2.59805 9.52V9.572C2.59825 10.5377 2.93242 11.4736 3.5439 12.2211C4.15538 12.9685 5.00653 13.4815 5.95305 13.673C5.33667 13.84 4.69036 13.8647 4.06305 13.745C4.32992 14.5762 4.85006 15.3032 5.55064 15.8241C6.25123 16.345 7.09718 16.6338 7.97005 16.65C7.10253 17.3313 6.10923 17.835 5.04693 18.1322C3.98464 18.4294 2.87418 18.5143 1.77905 18.382C3.69075 19.6114 5.91615 20.2641 8.18905 20.262C15.8821 20.262 20.0891 13.889 20.0891 8.362C20.0891 8.182 20.0841 8 20.0761 7.822C20.8949 7.23017 21.6017 6.49702 22.1631 5.657L22.1621 5.656Z"
                                    fill="#0EA5E9" />
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="social-share">
                    <a href="https://www.linkedin.com/login" target="_blank">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0_1_3078" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                width="24" height="24">
                                <path d="M0 0H24V24H0V0Z" fill="white" />
                            </mask>
                            <g mask="url(#mask0_1_3078)">
                                <path
                                    d="M6.93994 4.99999C6.93968 5.53043 6.72871 6.03903 6.35345 6.41391C5.97819 6.7888 5.46937 6.99926 4.93894 6.99899C4.40851 6.99873 3.89991 6.78776 3.52502 6.4125C3.15014 6.03724 2.93968 5.52843 2.93994 4.99799C2.94021 4.46756 3.15117 3.95896 3.52644 3.58407C3.9017 3.20919 4.41051 2.99873 4.94094 2.99899C5.47137 2.99926 5.97998 3.21023 6.35486 3.58549C6.72975 3.96075 6.94021 4.46956 6.93994 4.99999V4.99999ZM6.99994 8.47999H2.99994V21H6.99994V8.47999ZM13.3199 8.47999H9.33994V21H13.2799V14.43C13.2799 10.77 18.0499 10.43 18.0499 14.43V21H21.9999V13.07C21.9999 6.89999 14.9399 7.12999 13.2799 10.16L13.3199 8.47999V8.47999Z"
                                    fill="#0EA5E9" />
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="product-page1-nine-sec mt-24">
        <div class="container">
            <div class="review-product-page-full">
                <div class="row">
                    <div class="col-8">
                        <h3 class="review-txt">Reviews</h3>
                    </div>
                    <div class="col-4 d-flex justify-content-end align-items-center">
                        <a href="review.html">
                            <p class="see-all-review-txt">See all<span><img
                                        src="{{ asset('frontend/new/images/homepage/see-all-icon.svg') }}"
                                        alt="menu-icon"></span></p>
                        </a>
                    </div>
                </div>
                <div class="review-bottom-sec">
                    <div class="row ">
                        <div class="col-4">
                            <div class="review-first-sec">

                                @php

                                    $reviewcount = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->latest()
                                        ->get();

                                    $avarage = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->avg('rating');
                                @endphp

                                <p class="rev1-txt">{{ count($reviewcount) }}</p>
                                <p class="rev2-txt">out of 5</p>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="row h-10 d-flex align-items-center">
                                <div class="col-3 d-flex align-items-center justify-content-end">
                                    <div class="review-sec-star">
                                        <ul>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }} "
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }} "
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }} "
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }} "
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }} "
                                                    alt="yellow-star"></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div class="col-12 ">
                                        <div class="progress custom-progress">
                                            <div class="progress-bar custom-progress-bar w-105" role="progressbar"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-10 d-flex align-items-center">
                                <div class="col-3 d-flex align-items-center justify-content-end">
                                    <div class="review-sec-star">
                                        <ul>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }}"
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }}"
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }}"
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }}"
                                                    alt="yellow-star"></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div class="col-12 ">
                                        <div class="progress custom-progress">
                                            <div class="progress-bar custom-progress-bar w-145" role="progressbar"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-10 d-flex align-items-center">
                                <div class="col-3 d-flex align-items-center justify-content-end">
                                    <div class="review-sec-star">
                                        <ul>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }}"
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }}"
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }}"
                                                    alt="yellow-star"></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div class="col-12 ">
                                        <div class="progress custom-progress">
                                            <div class="progress-bar custom-progress-bar w-90" role="progressbar"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-10 d-flex align-items-center">
                                <div class="col-3 d-flex align-items-center justify-content-end">
                                    <div class="review-sec-star">
                                        <ul>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }}"
                                                    alt="yellow-star"></li>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }}"
                                                    alt="yellow-star"></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div class="col-12 ">
                                        <div class="progress custom-progress">
                                            <div class="progress-bar custom-progress-bar w-45" role="progressbar"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row h-10 d-flex align-items-center">
                                <div class="col-3 d-flex align-items-center justify-content-end">
                                    <div class="review-sec-star">
                                        <ul>
                                            <li><img src="{{ asset('frontend/new/images/single-product-page/yellow-star.png') }}"
                                                    alt="yellow-star"></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-9 d-flex align-items-center">
                                    <div class="col-12">
                                        <div class="progress custom-progress">
                                            <div class="progress-bar custom-progress-bar w-10" role="progressbar"
                                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
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
    </div>

    <div class="row mt-60">
        <div class="col-12">
            <h2 class="section-title style-1 mb-30">Related products</h2>
        </div>
        <div class="col-12">
            <div class="row related-products">


                @foreach ($relatedProduct as $product)
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="product-cart-wrap hover-up">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/' . $product->product_slug . '-' . $product->id . '.html') }}"
                                        tabindex="0">
                                        <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                            alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}"
                                        onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                        onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                </div>

                                @php
                                    $amount = $product->selling_price - $product->discount_price;
                                    $discount = ($amount / $product->selling_price) * 100;

                                @endphp
                                <div class="product-badges product-badges-position product-badges-mrg">

                                    @if ($product->discount_price == null)
                                        <span class="new">New</span>
                                    @else
                                        <span class="hot"> {{ round($discount) }} %</span>
                                    @endif

                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2><a href="{{ url('product/details/' . $product->product_slug . '-' . $product->id . '.html') }}"
                                        tabindex="0">{{ $product->product_name }}</a></h2>
                                <div class="rating-result" title="90%">
                                    <span> </span>
                                </div>

                                @if ($product->discount_price == null)
                                    <div class="product-price">
                                        <span>@price($product->selling_price)</span>

                                    </div>
                                @else
                                    <div class="product-price">
                                        <span>@price($product->discount_price)</span>
                                        <span class="old-price">@price($product->selling_price)</span>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    <div class="product-page2-fourth-sec">
        <div class="product-page2-fourth-sec-wrap">
            <div class="product-incre">
                <a href="javascript:void(0)" class="product__minus sub">
                    <span>
                        <svg width="8" height="8" viewBox="0 0 8 2" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1H7" stroke="#666666" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </a>
                <input name="quantity" type="text" class="product__input" id="product_dqty" value="1">
                <a href="javascript:void(0)" class="product__plus add">
                    <span>
                        <svg width="8" height="8" viewBox="0 0 8 8" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 4H7" stroke="#0EA5E9" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                            <path d="M4 7V1" stroke="#0EA5E9" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </a>
            </div>
            <div class="product-page2-flex">
                <div class="product-page2-cart-btn">
                    <a onclick="addToCartDetil()"><i class="fi-rs-shopping-cart"></i></a>
                </div>
                <div class="product-page2-buy-btn">
                    <a href="{{ route('checkout') }}">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function addToCartDetil() {

        var product_name = $('#product_dname').text();
        var id = $('#product_did').val();
        
        var quantity = $('#product_dqty').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                quantity: quantity,
                product_name: product_name,
            },
            url: "/cart/data/store/" + id,
            success: function(data) {
                miniCart();
                $('#closeModal').click();

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })

                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }

                // End Message  
            }
        })

    }
</script>

@endsection
