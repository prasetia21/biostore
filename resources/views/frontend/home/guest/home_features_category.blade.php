    <div class="homepage2-second-sec mt-24">
        <div class="container">
            <div class="product-details">

                @foreach ($categories as $item)
                    <div class="product-sec">
                        <a href="{{ url('guest/product/category/' . $item->category_slug . '-' . $item->id . '.html') }}" rel="noreferrer noopener">
                            <div class="product-img-sec">
                                <img src="{{ asset($item->category_image) }}" alt="furniture-img">
                            </div>
                            <h3 class="proct-title-hp-2">{{ $item->category_name }}</h3>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
