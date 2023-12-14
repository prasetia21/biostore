
     <div class="homepage2-seventh-sec mt-24">
        <div class="container">
            <div class="tranding-item-sec">
                <div class="home-tranding-first">
                    <h2 class="home-cate-title">Featured Items</h2>
                </div>
                <div class="home-tranding-second">
                    <a href="{{ route('shop.page.guest') }}">
                        <p class="see-all-txt">See all<span><img
                                    src="{{ asset('frontend/new/images/homepage/see-all-icon.svg') }}"
                                    alt="right-arrow"></span></p>
                    </a>
                </div>
            </div>
        </div>
         <div class="container">

        
             <div class="favourite-bottom-sec mt-50">
                 <div class="favourite-bottom-sec-wrapper">
                     @foreach ($catalogProduct as $product)
                         <div class="related-item">


                             <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                 data-wow-delay=".1s">
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
                                     
                                         
                                     <div class="img-bottom-content">
     
                                        
                                        <div class="img-first-content">
                                            <p><a
                                                href="{{ url('guest/product/category/' . $product['category']['category_slug'] . '-' . $product['category']['id'] . '.html') }}">{{ $product['category']['category_name'] }}</a></p>
                                        </div>
                          
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
                                 <div class="product-content-wrap mt-30">
                                     
                                     <h2><a
                                             href="{{ url('guest/product/details/' . $product->product_slug . '-' . $product->id . '.html') }}">
                                             {{ $product->product_name }} </a></h2>
                                     @php

                                         $reviewcount = App\Models\Review::where('product_id', $product->id)
                                             ->where('status', 1)
                                             ->latest()
                                             ->get();

                                         $avarage = App\Models\Review::where('product_id', $product->id)
                                             ->where('status', 1)
                                             ->avg('rating');
                                     @endphp

                                     <div class="product-rate-cover">
                                         <div class="product-rate d-inline-block">

                                             @if ($avarage == 0)
                                             @elseif($avarage == 1 || $avarage < 2)
                                                 <div class="product-rating" style="width: 20%"></div>
                                             @elseif($avarage == 2 || $avarage < 3)
                                                 <div class="product-rating" style="width: 40%"></div>
                                             @elseif($avarage == 3 || $avarage < 4)
                                                 <div class="product-rating" style="width: 60%"></div>
                                             @elseif($avarage == 4 || $avarage < 5)
                                                 <div class="product-rating" style="width: 80%"></div>
                                             @elseif($avarage == 5 || $avarage < 5)
                                                 <div class="product-rating" style="width: 100%"></div>
                                             @endif
                                         </div>
                                         <span class="font-small ml-5 text-muted">
                                             ({{ count($reviewcount) }})</span>
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
                                                     class="fi-rs-shopping-cart mr-5"></i>Detail </a>
                                         </div>
                                     </div>
                                 </div>
                             </div>


                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
     </div>
