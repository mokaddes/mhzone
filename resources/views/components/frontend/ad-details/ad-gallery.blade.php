<div>
    <div class="product-item__gallery">

        <div  style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
            <div class="swiper-wrapper" id="lightgallery">
                <!-- <div class="swiper-slide"> -->
                   <a href="{{ getPhoto($thumbnail) }}" class="swiper-slide">
                        <img src="{{ getPhoto($thumbnail) }}" alt="product-img" />
                   </a>
                <!-- </div> -->
                @foreach ($galleries as $gallery)
                    <!-- <div class="swiper-slide"> -->
                        <a href="{{ getPhoto($gallery->image) }}" class="swiper-slide">
                            <img src="{{ getPhoto($gallery->image) }}" alt="product-img" />
                        </a>
                    <!-- </div> -->
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- <div class="view">
                <a class="icon" href="{{ route('frontend.ad.gallery.details', $slug) }}">
                    <x-svg.full-screen-icon />
                </a>
            </div> -->
        </div>

        <div thumbsSlider="" class="swiper mySwiper" style="height: 125px">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ getPhoto($thumbnail) }}" alt="product-img" />
                </div>
                @foreach ($galleries as $gallery)
                    <div class="swiper-slide">
                        <img src="{{ getPhoto($gallery->image) }}" alt="product-img" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>






 
 
