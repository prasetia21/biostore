@extends('frontend.guest_dashboard')
@section('main')

@section('title')
     Hasil Pencarian Tentang {{ $item }}
@endsection


<div class="page-header mt-30 mb-50">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-12">

                    <div class="breadcrumb">
                        <a href="{{ url('/guest/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> {{ $item }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>We found <strong class="text-brand">{{ count($products) }}</strong> items for you!</p>
                </div>
             
            </div>
            <div class="row product-grid">


                @foreach ($products as $product)
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a
                                        href="{{ url('guest/product/details/' . $product->product_slug . '-' . $product->id . '.html') }}">
                                        <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                            alt="" />

                                    </a>
                                </div>
                                <div class="product-action-1">
                                

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
                                <div class="product-category">
                                    <a
                                        href="{{ url('guest/product/category/' . $product['category']['category_slug'] . '-' . $product['category']['id'] . '.html') }}">{{ $product['category']['category_name'] }}</a>
                                </div>
                                <h2><a
                                        href="{{ url('guest/product/details/' . $product->product_slug . '-' . $product->id . '.html') }}">
                                        {{ $product->product_name }} </a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>

                                <div class="product-card-bottom">

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



                                    <div class="add-cart">
                                        <a class="add"
                                            href="{{ url('guest/product/details/' . $product->product_slug . '-' . $product->id . '.html') }}"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                @endforeach






            </div>



        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-category-2 mb-30">
                <h5 class="section-title style-1 mb-30">Category</h5>
                <ul>

                    @foreach ($categories as $category)
                        @php

                            $products = App\Models\Product::where('category_id', $category->id)->get();

                        @endphp


                        <li>
                            <a
                                href="{{ url('guest/product/category/' . $category->category_slug . '-' . $category->id . '.html') }}">
                                <img src=" {{ asset($category->category_image) }} "
                                    alt="" />{{ $category->category_name }}</a><span
                                class="count">{{ count($products) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- Fillter By Price -->

            <!-- Product sidebar Widget -->
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                <h5 class="section-title style-1 mb-30">New products</h5>

                @foreach ($newProduct as $product)
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="{{ asset($product->product_thumbnail) }}" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <p><a
                                    href="{{ url('guest/product/details/' . $product->product_slug . '-' . $product->id . '.html') }}">{{ $product->product_name }}</a>
                            </p>

                            @if ($product->discount_price == null)
                                <p class="price mb-0">@price($product->selling_price)</p>
                            @else
                                <p class="price mb-0">@price($product->discount_price)</p>
                            @endif

                            <div class="product-rate">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>


        </div>
    </div>
</div>




@endsection
