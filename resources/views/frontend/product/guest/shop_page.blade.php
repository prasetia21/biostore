@extends('frontend.guest_dashboard')
@section('main')

@section('title')
    Shop Page
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-header mt-30 mb-50">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <h5 class="mb-15"> Shop Page </h5>
                    <div class="breadcrumb">
                        <a href="{{ url('/guest/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> Shop Page
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container mb-30">
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            
            <div class="row product-grid">


                @foreach ($products as $product)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
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

            <!-- Fillter By Price -->


            <div class="sidebar-widget price_range range mb-30">

                <form method="post" action="{{ route('shop.filter.guest') }}">
                    @csrf

                   
                    <div class="list-group">
                        <div class="list-group-item mb-10 mt-10">


                            @if (!empty($_GET['category']))
                                @php
                                    $filterCat = explode(',', $_GET['category']);
                                @endphp
                            @endif


                            <label class="fw-900">Category</label>
                            @foreach ($categories as $category)
                                @php
                                    $products = App\Models\Product::where('category_id', $category->id)->get();
                                @endphp

                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="category[]"
                                        id="exampleCheckbox{{ $category->id }}"
                                        value="{{ $category->category_slug }}"
                                        @if (!empty($filterCat) && in_array($category->category_slug, $filterCat)) checked @endif
                                        onchange="this.form.submit()" />
                                    <label class="form-check-label"
                                        for="exampleCheckbox{{ $category->id }}"><span>{{ $category->category_name }}
                                            ({{ count($products) }})</span></label>

                                </div>
                            @endforeach


                            @if (!empty($_GET['brand']))
                                @php
                                    $filterBrand = explode(',', $_GET['brand']);
                                @endphp
                            @endif


                            <label class="fw-900 mt-15">Brand</label>
                            @foreach ($brands as $brand)
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="brand[]"
                                        id="exampleBrand{{ $brand->id }}" value="{{ $brand->brand_slug }}"
                                        @if (!empty($filterBrand) && in_array($brand->brand_slug, $filterBrand)) checked @endif
                                        onchange="this.form.submit()" />
                                    <label class="form-check-label"
                                        for="exampleBrand{{ $brand->id }}"><span>{{ $brand->brand_name }}
                                        </span></label>

                                </div>
                            @endforeach

                        </div>
                    </div>

            </div>


            </form>


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
                                <p class="price mt-2">@price($product->selling_price)</p>
                            @else
                                <p class="price mt-2">@price($product->discount_price)</p>
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

<script type="text/javascript">
    $(document).ready(function() {
        if ($('#slider-range').length > 0) {
            const max_price = parseInt($('#slider-range').data('max'));
            const min_price = parseInt($('#slider-range').data('min'));
            let price_range = min_price + "-" + max_price;

            let price = price_range.split('-');

            $("#slider-range").slider({
                range: true,
                min: min_price,
                max: max_price,
                values: price,
                slide: function(event, ui) {

                    $("#amount").val('Rp' + ui.values[0] + "-" + 'Rp' + ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
        }
    })
</script>


@endsection
