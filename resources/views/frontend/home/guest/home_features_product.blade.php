<div class="homepage2-fourth-sec mt-24">
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
    <div class="featured-description mt-16">

        @foreach ($featured as $item)
            <a href="{{ url('guest/product/details/' . $item->product_slug . '-' . $item->id . '.html') }}">
                <div class="featured-description-full">
                    <div class="featured-img-sec">
                        <img src="{{ asset($item->product_thumbnail) }}" alt="furniture-img" class="img-fluid">
                    </div>

                    <div class="featured-content">
                        <div class="featured-content1">
                            <div class="feat-details1">
                                <p class="feat-txt1">{{ $item->product_name }}</p>
                            </div>
                            <div class="feat-details2">
                                <ul class="homepage-rating-sec1">
                                    <li><img src="{{ asset('frontend/new/images/homepage/yellow-star.svg') }}"
                                            alt="yellow-star"></li>
                                    <li><img src="{{ asset('frontend/new/images/homepage/yellow-star.svg') }}"
                                            alt="yellow-star"></li>
                                    <li><img src="{{ asset('frontend/new/images/homepage/yellow-star.svg') }}"
                                            alt="yellow-star"></li>
                                    <li><img src="{{ asset('frontend/new/images/homepage/yellow-star.svg') }}"
                                            alt="yellow-star"></li>
                                    <li><img src="{{ asset('frontend/new/images/homepage/light-yellow-star.svg') }}"
                                            alt="light-yellow-img"></li>
                                </ul>
                            </div>
                        </div>
                        @php
                            $amount = $item->selling_price - $item->discount_price;
                            $discount = ($amount / $item->selling_price) * 100;
                        @endphp

                        <h3 class="feat-txt2">{{ $item->short_desc }}</h3>

                        @if ($item->discount_price == null)
                            <h4 class="feat-txt3">Rp. {{ $item->selling_price }}</h4>
                        @else
                        <h4 class="feat-txt3">
                            <span>Rp.{{ $item->discount_price }} </span> 
                            <span class="old-price"><del>Rp.{{ $item->selling_price }}</del></span>
                        </h4>
                        @endif

                    </div>

                </div>
            </a>
        @endforeach

    </div>
</div>
