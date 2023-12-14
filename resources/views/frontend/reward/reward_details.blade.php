@extends('frontend.master_dashboard')
@section('main')

@section('title')
    {{ $reward->reward_name }}
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span>{{ $reward->reward_name }}
        </div>
    </div>

</div>
<div class="container mb-30">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="product-detail accordion-detail">
                <div class="row mb-50 mt-30">
                    <div class="col-md-4 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">
                                @foreach ($multiImageReward as $img)
                                    <figure class="border-radius-10">
                                        <img src="{{ asset($img->image_name) }} " alt="reward image" />
                                    </figure>
                                @endforeach
                            </div>
                            <!-- THUMBNAILS -->
                            <div class="slider-nav-thumbnails">
                                @foreach ($multiImageReward as $img)
                                    <div><img src="{{ asset($img->image_name) }}" alt="reward image" /></div>
                                @endforeach

                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>

                    <div class="col-md-8 col-sm-12 col-xs-12">
                        @php
                            $ids = Auth::user();
                        @endphp



                        @if (empty($ids))
                            <div class="detail-info pr-30 pl-30">
                                <h2>Detail Reward {{ $reward->reward_name }}</h2>
                                <hr>
                            </div>
                        @else
                            @php
                                $users = App\Models\Point::where('user_id', $ids->id)->get();
                                
                            @endphp
                            <div class="detail-info pr-30 pl-30">
                                <h2>Your Point : <span
                                        class="current-price text-brand">{{ $users[0]['total_poin'] }}</span> </h2>
                                <hr>
                            </div>
                        @endif

                        <div class="detail-info pr-30 pl-30">
                            @if ($reward->reward_qty > 0)
                                <span class="stock-status in-stock">Available </span>
                            @else
                                <span class="stock-status out-stock">Not Available </span>
                            @endif



                            <h2 class="title-detail" id="drname"> {{ $reward->reward_name }} </h2>

                            <div class="clearfix reward-price-cover">

                                <div class="product-price primary-color float-left">
                                    <span class="current-price text-brand">{{ $reward->rendeem_amount }} BioPoint</span>

                                </div>


                            </div>


                            <div class="detail-extralink mb-50">
                                
                                <div class="reward-extra-link2">
                                    <form method="post" action="{{ route('rendeem') }}">
                                        @csrf
                                        <div class="detail-qty border radius">

                                            <input type="text" name="quantity" id="drqty" class="qty-val" value="1"
                                                max="1" readonly>
        
                                        </div>
                                        <input type="hidden" name="id" id="drreward_id"
                                            value="{{ $reward->id }}">


                                        <input type="hidden" name="user_id" value="{{ $ids->id }}">
                                        <input type="hidden" name="reward_name" value="{{ $reward->reward_name }}">
                                        <input type="hidden" name="reward_qty" value="{{ $reward->reward_qty }}">
                                        <input type="hidden" name="rendeem_amount"
                                            value="{{ $reward->rendeem_amount }}">
                                        <button type="submit" class="button button-add-to-cart"><i
                                                class="fi-rs-shopping-cart"></i>Tukar Poin</button>
                                    </form>
                                    {{-- {{ dd($reward) }} --}}

                                </div>
                            </div>

                            <hr>

                            <div class="font-xs">

                                <ul class="float-start">
                                    <li class="mb-5">Reward Code: <a href="#">{{ $reward->reward_code }}</a>
                                    </li>

                                    <li>Qty:<span class="in-stock text-brand ml-5">({{ $reward->reward_qty }})
                                            Available for Rendeem</span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
                <div class="product-info">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                    href="#Description">Description</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab entry-main-content">
                            <div class="tab-pane fade show active" id="Description">
                                <div class="">
                                    <p> {!! $reward->reward_desc !!} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- <div class="row mt-60">
                    <div class="col-12">
                        <h2 class="section-title style-1 mb-30">Related rewards</h2>
                    </div>
                    <div class="col-12">
                        <div class="row related-product">


                            @foreach ($relatedreward as $reward)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ url('reward/details/' . $reward->reward_slug . '-' . $reward->id . '.html') }}"
                                                    tabindex="0">
                                                    <img class="default-img"
                                                        src="{{ asset($reward->reward_thumbnail) }}"
                                                        alt="" />

                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up"
                                                    data-bs-toggle="modal" data-bs-target="#quickViewModal"><i
                                                        class="fi-rs-search"></i></a>
                                                
                                            </div>

                                        </div>
                                        <div class="product-content-wrap">
                                            <h2><a href="shop-reward-right.html"
                                                    tabindex="0">{{ $reward->reward_name }}</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span> </span>
                                            </div>

                                            <div class="product-price">
                                                <span>Reward Code: {{ $reward->reward_code }}</span>
                                                
                                            </div>

                                            <div class="product-price">
                                                <span>{{ $reward->rendeem_amount }} Point</span>
                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</div>

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

@endsection
