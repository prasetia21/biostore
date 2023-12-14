@extends('frontend.master_dashboard')
@section('main')

@section('title')
    Reward Page
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-header mt-30 mb-50">
    <div class="container">
        <div class="archive-header">
            <div class="row align-items-center">
                <div class="col-xl-3">
                    <h5 class="mb-15"> Reward Page </h5>
                    <div class="breadcrumb">
                        <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                        <span></span> Reward Page
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
                    <p>We found <strong class="text-brand">{{ count($rewards) }}</strong> reward items for you!</p>
                </div>
                <div class="sort-by-product-area">
                    <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Show:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">50</a></li>
                                <li><a href="#">100</a></li>
                                <li><a href="#">150</a></li>
                                <li><a href="#">200</a></li>
                                <li><a href="#">All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Point: Low to High</a></li>
                                <li><a href="#">Point: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row product-grid">


                @foreach ($rewards as $reward)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a
                                        href="{{ url('product/details/' . $reward->reward_slug . '-' . $reward->id . '.html') }}">
                                        <img class="default-img" src="{{ asset($reward->reward_thumbnail) }}"
                                            alt="" />

                                    </a>
                                </div>
                                <div class="product-action-1">

                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal" id="{{ $reward->id }}"
                                        onclick="rewardView(this.id)"><i class="fi-rs-eye"></i></a>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2><a
                                        href="{{ url('reward/details/' . $reward->reward_slug . '-' . $reward->id . '.html') }}">
                                        {{ $reward->reward_name }} </a></h2>
                                <div>
                                    <span class="font-small text-muted">By <a
                                                href="#">Admin</a></span>
                                   
                                </div>
                                <div class="product-card-bottom">

                                    <div class="product-price">
                                            <span>{{ $reward->rendeem_amount }} BioPoint</span>

                                        </div>
                                    <div class="add-cart">
                                        <a class="add"
                                            href="{{ url('reward/details/' . $reward->reward_slug . '-' . $reward->id . '.html') }}"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Details </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                @endforeach






            </div>
            <!--product grid-->
            <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!--End Deals-->


        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">

            <!-- Fillter By Price -->


            <div class="sidebar-widget price_range range mb-30">

                <form method="post" action="{{ route('reward.filter') }}">
                    @csrf

                    <h5 class="section-title style-1 mb-30">Filter BioPoint</h5>
                    <div class="price-filter">
                        <div class="price-filter-inner">

                            <div id="slider-range" class="price-filter-range" data-min="0" data-max="200000">
                            </div>
                            <input type="hidden" id="price_range" name="price_range" value="">
                            <input type="text" id="amount" value="0 - 200000" readonly="">

                            <br><br>

                            <button type="submit" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i>
                                Filter</button>

                        </div>
                    </div>
            </div>


            </form>


            <!-- Reward sidebar Widget -->
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                <h5 class="section-title style-1 mb-30">New Rewards</h5>

                @foreach ($newReward as $reward)
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="{{ asset($reward->reward_thumbnail) }}" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <p><a
                                    href="{{ url('reward/details/' . $reward->reward_slug . '-' . $reward->id . '.html') }}">{{ $reward->reward_name }}</a>
                            </p>


                                <p class="price mb-0 mt-5">{{ $reward->rendeem_amount }} BioPoint</p>
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

                    $("#amount").val(ui.values[0] + "-" + ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
        }
    })
</script>


@endsection
