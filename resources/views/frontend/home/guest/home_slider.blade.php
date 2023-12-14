     <div class="homepage2-third-sec mt-24">
        <div class="container">
            <div class="prodcut-sec-slide">
                @foreach ($slider as $item)
                <div style="background-image: url({{ asset($item->slider_image) }});background-repeat: no-repeat;background-position: center;background-size: cover;max-width: 100%;position: relative;border-radius: 8px;display: -webkit-box !important;display: -ms-flexbox !important;display: flex !important;-webkit-box-pack: justify;-ms-flex-pack: justify;justify-content: space-between;">
                    <div class="slider-img-sec">
                    <div class="slider-content-sec">
                        <div class="slider-content-sec-full">
                            <p class="slider-pro-title">{{ $item->slider_title }}</p>
                            <h3 class="slider-pro-subtitle">{{ $item->slider_desc }}</h3>
                            <div class="slider-btn">
                                <a href="{{ $item->slider_link }}">Shop Now</a>	
                            </div>
                        </div>	
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
