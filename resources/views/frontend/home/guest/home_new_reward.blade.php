@php
$rewards = App\Models\Reward::where('status', 1)
    ->orderBy('id', 'ASC')
    ->limit(10)
    ->get();
@endphp

<section class="product-tabs section-padding position-relative">
<div class="container">
    <div class="section-title style-2 wow animate__animated animate__fadeIn">
        <h3> New Rewards </h3>
        <ul class="nav nav-tabs links" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                    type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
            </li>
        </ul>
    </div>
    <!--End nav-tabs-->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
            <div class="row product-grid-4">

                @foreach ($rewards as $reward)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                            data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a
                                        href="{{ url('reward/details/' . $reward->reward_slug . '-' . $reward->id . '.html') }}">
                                        <img class="default-img"
                                            src="{{ asset($reward->reward_thumbnail) }}" alt="" />

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
                      

                        
                                <div class="product-card-bottom">

                                    <div class="product-price">
                                            <span>{{ $reward->rendeem_amount }} BioPoint</span>

                                        </div>

                                    <div class="add-cart">
                                        <a class="add"
                                            href="{{ url('reward/details/' . $reward->reward_slug . '-' . $reward->id . '.html') }}"><i
                                                class="fi-rs-shopping-cart mr-5"></i>Detail </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end reward card-->
                @endforeach




            </div>
            <!--End reward-grid-4-->
        </div>
        <!--En tab one-->



        {{-- @foreach ($vouchers as $voucher)
            <div class="tab-pane fade" id="category{{ $voucher->id }}" role="tabpanel"
                aria-labelledby="tab-two">
                <div class="row product-grid-4">

                    @php
                        $catwiseReward = App\Models\Reward::where('voucher_id', $voucher->id)
                            ->orderBy('id', 'DESC')
                            ->get();
                    @endphp

                    @forelse($catwiseReward as $reward)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a
                                            href="{{ url('reward/details/' . $reward->reward_slug . '-' . $reward->id . '.html') }}">
                                            <img class="default-img"
                                                src="{{ asset($reward->reward_thumbnail) }}"
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
                                    <div class="product-category">
                                        <a
                                            href="{{ url('product/category/' . $category->category_slug . '-' . $category->id . '.html') }}">{{ $reward['voucher']['voucher_name'] }}</a>
                                    </div>
                                    <h2><a
                                            href="{{ url('reward/details/' . $reward->reward_slug . '-' . $reward->id . '.html') }}">
                                            {{ $reward->reward_name }} </a></h2>
                                    
                                    <div class="product-card-bottom">

                                        <div class="product-price">
                                                <span>Rp.{{ $reward->rendeem_amount }}</span>

                                            </div>



                                        <div class="add-cart">
                                            <a href="{{ url('reward/details/' . $reward->reward_slug . '-' . $reward->id . '.html') }}"
                                                class="btn w-100 hover-up"><i
                                                    class="fi-rs-shopping-cart mr-5"></i>Detail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end reward card-->

                    @empty

                        <h5 class="text-danger"> No Reward Found </h5>
                    @endforelse




                </div>
                <!--End reward-grid-4-->
            </div>
            <!--En tab two-->
        @endforeach --}}


    </div>
    <!--End tab-content-->
</div>
</section>
