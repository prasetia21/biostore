
<div class="homepage2-sixth-sec mt-24">
    <div class="container">
        <div class="tranding-item-sec" >
            <div class="home-tranding-first">
                <h2 class="home-cate-title">Reward Product</h2>
            </div>
        </div>
    </div>
    <div class="home2-inspiration mt-16">
        @foreach ($reward as $item)
        <div class="inspiration-sec-bottom-home2">
            <div class="home2-insp-img">
                <div class="inspiration-overlay"></div>
                <img style="width: 200px;height:200px" src="{{ asset($item->reward_thumbnail) }}" alt="furniture-img" class="img-fluid">
                <div class="home2-insp-content">
                    <h3 class="inspiration-title-home2">{{ $item->reward_name }}</h3>
                    <h4 class="inspiration-subtitle-home2">{{ $item->rendeem_amount }} BioPoin</h4>	
                </div>
            </div>
        </div>
        @endforeach


    </div>			
</div>
