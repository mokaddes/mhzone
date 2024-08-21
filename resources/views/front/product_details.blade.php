@extends('front.layouts.master')
@section('title', __('Ad Post Details'))
@section('meta')
    @php
        $data = metaData('login');
    @endphp
    <meta name="title" content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif">
    <meta name="description"
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif">
    <meta property="og:image" content="{{ $data->image_url }}" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title"
        content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif">
    <meta property="og:url" content="{{ route('frontend.index') }}">
    <meta property="og:type" content="article">
    <meta property="og:description"
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif">
    <meta name=twitter:card content={{ $data->image_url }} />
    <meta name=twitter:site content="{{ config('app.name') }}" />
    <meta name=twitter:url content="{{ route('frontend.index') }}" />
    <meta name=twitter:title
        content="@if (currentLanguage()->code == 'lv') {{ $data->title_lv }} @else {{ $data->title }} @endif" />
    <meta name=twitter:description
        content="@if (currentLanguage()->code == 'lv') {{ $data->description_lv }} @else {{ $data->description }} @endif" />
    <meta name=twitter:image content="{{ $data->image_url }}" />
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="{{ asset('front/assets/css/lightgallery-bundle.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
@endpush
@section('content')

    <!-- ============================== product details ================================== -->
    <div class="products_details_sec mb-5">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6 col-xl-6">
                    <div class="product_gallery">
                        <div class="product-item__gallery single_product">
                            <div class="swiper mySwiper2">
                                <div class="swiper-wrapper single_item" id="lightgallery">
                                    @if (isset($ad->thumbnail))
                                        <a class="swiper-slide" href="{{ asset($ad->thumbnail) }}">
                                            <img src="{{ asset($ad->thumbnail) }}" alt="image" />
                                        </a>
                                    @endif
                                    @if (isset($ad->galleries) && $ad->galleries->count() > 0)
                                        @foreach ($ad->galleries as $gallery)
                                            <a class="swiper-slide" href="{{ asset($gallery->image) }}">
                                                <img src="{{ asset($gallery->image) }}" alt="image" />
                                            </a>
                                        @endforeach
                                    @endif
                                    @if (!isset($ad->thumbnail) && $ad->galleries->count() < 1)
                                        <a class="swiper-slide" href="{{ asset('front/no-image.png') }}">
                                            <img src="{{ asset('front/no-image.png') }}" alt="image" />
                                        </a>
                                    @endif
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    @if (isset($ad->thumbnail))
                                        <div class="swiper-slide">
                                            <img src="{{ asset($ad->thumbnail) }}" alt="image" />
                                        </div>
                                    @endif
                                    @if (isset($ad->galleries) && $ad->galleries->count() > 0)
                                        @foreach ($ad->galleries as $gallery)
                                            <div class="swiper-slide">
                                                <img src="{{ asset($gallery->image) }}" alt="image" />
                                            </div>
                                        @endforeach
                                    @endif
                                    @if (!isset($ad->thumbnail) && $ad->galleries->count() < 1)
                                        <div class="swiper-slide">
                                            <img src="{{ asset('front/no-image.png') }}" alt="image" />
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6">
                    <div class="product_details">
                        <h3>{{ $ad->title }}</h3>
                        <p>
                            {{ $ad->description }}
                        </p>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <div class="delivery_info mb-3">
                                    <h4>Return / Exchange Policy</h4>
                                    <p>
                                        {{ $user->userShop->return_policy ?? '' }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="seller-profile position-relative">
                                    <div class="d-flex align-items-center">
                                        <div class="seller-img me-3">
                                            <a href=""><img
                                                    src="{{ asset($user->userShop->logo ?? 'front/assets/images/profile.png') }}"
                                                    width="45" alt="user name"></a>
                                        </div>
                                        <div class="seller-info">
                                            <h4><a href="{{ route('frontend.seller.shop', $user->userShop->slug) }}"
                                                    class="stretched-link">{{ $user->userShop->name ?? '' }}</a></h4>
                                            <span>{{ $user->ads()->active()->count() }} items for sale</span>
                                            <br>
                                            <a href="{{ route('frontend.seller.shop', $user->userShop->slug) }}"
                                                class="badge bg-primary">Visit shop <i class="la la-arrow-right"></i>
                                            </a>
                                        </div>
                                        <br>
                                        <br>

                                    </div>

                                </div>
                            </div>
                        </div>

                        @if ($ad->size)
                            @php
                                $items = json_decode($ad->size);
                            @endphp
                            <h5><span>Size</span> | US
                                @foreach ($items as $value)
                                    {{ $value }}
                                @endforeach
                            </h5>
                        @endif
                        @if ($ad->discount > 0)
                            <h4>
                                <del>${{ $ad->price }}</del>
                                <strong>$<span id="product_price">{{ discount_cal($ad->price, $ad->discount) }}</span>
                                </strong>
                            </h4>
                        @else
                            <h4><strong>$<span id="product_price">{{ $ad->price }}</span></strong></h4>
                        @endif

                        <div class="d-xs-flex justify-content-between">
                            <div class="select_size mb-4">
                                @if (isset($ad->attrs) && $ad->attrs->count() > 0)
                                    @foreach ($ad->attrs as $attr)
                                        @if (isset($attr->attr_details))
                                            <h2>Select {{ $attr->parent_attr->name }}</h2>
                                            @foreach (json_decode($attr->attr_details, true) as $name => $price)
                                                <div class="form-check">
                                                    <input class="form-check-input selectSize" type="radio"
                                                        name="{{ $attr->parent_attr->name }}[]"
                                                        value="{{ $name }}" data-price="{{ $price }}"
                                                        data-attr_name="{{ $attr->parent_attr->name }}"
                                                        data-attr_id="{{ $attr->id }}"
                                                        {{ $loop->first ? 'checked' : '' }}
                                                        id="size_{{ $attr->id . $loop->index }}">
                                                    <label class="form-check-label"
                                                        for="size_{{ $attr->id . $loop->index }}">
                                                        {{ $name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <div class="select_size mb-4">
                                <h2>Select Quantity</h2>
                                <div class="cart_qty float-sm-end">
                                    <div class="d-sm-flex align-items-center">
                                        <button class="incrementBtnR">+</button>
                                        <input type="text" class="incrementNum" name="qty" id="selectQuantity"
                                            value="1" min="1" readonly>
                                        <button class="incrementBtnL">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product_btn text-center">
                            <a class="loading cart" href="javascript:void(0);"
                                onclick="addToCart('{{ $ad->id }}', 'cart'  )">Add to Cart</a>
                            <a class="loading checkout" href="javascript:void(0);"
                                onclick="addToCart('{{ $ad->id }}', 'checkout' )">Buy Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================== product details ================================== -->
    <!-- ============================== product review ================================== -->
    <div class="product_reviws mb-5">
        <div class="container">
            <div class="section_title mb-4">
                <h3>Ratings & Reviews</h3>
            </div>
            <div class="total_rating_review mb-3">
                <h2>{{ $reviews->count() ?? 0 }} Ratings</h2>
                <h3>{{ round($reviews->avg('stars') ?? 0, 2) }} / <sub>5</sub></h3>
                <div id="avg_rate"></div>
                <!-- <img src="{{ asset('frontend/images/icon/star.svg') }}" width="15" alt="star">
                    <img src="{{ asset('frontend/images/icon/star.svg') }}" width="15" alt="star">
                    <img src="{{ asset('frontend/images/icon/star.svg') }}" width="15" alt="star">
                    <img src="{{ asset('frontend/images/icon/star.svg') }}" width="15" alt="star">
                    <img src="{{ asset('frontend/images/icon/star-half.svg') }}" width="15" alt="star"> -->
            </div>

            <div class="user_review">
                {{-- review --}}
                @if (!empty($reviews) && count($reviews) > 0)
                    @foreach ($reviews as $review)
                        <div class="review">
                            <div class="d-flex position-relative align-items-center mb-3">
                                <div class="user_img me-3">
                                    <img src="{{ asset($review->user->image ?? 'front/assets/images/profile.png') }}"
                                        alt="">
                                </div>
                                <div class="user_info">
                                    <h5>{{ $review->user->name ?? ''  }}</h5>
                                    <h6>{{ date('d M Y', strtotime($review->created_at)) }}</h6>
                                    <div id="user_rate_{{ $review->id }}"></div>
                                    <script>
                                        var review_id = "{{ $review->id }}";
                                        var rate = "{{ $review->stars }}";
                                        $("#user_rate_" + review_id).rateYo({
                                            starWidth: '15px',
                                            fullStar: true,
                                            mormalFill: 'yellow',
                                            ratedFill: 'orange',
                                            rating: rate,
                                            readOnly: true
                                        });
                                    </script>
                                    <!-- <img src="{{ asset('frontend/images/icon/star.svg') }}" width="15" alt="star">
                                    <img src="{{ asset('frontend/images/icon/star.svg') }}" width="15" alt="star">
                                    <img src="{{ asset('frontend/images/icon/star.svg') }}" width="15" alt="star">
                                    <img src="{{ asset('frontend/images/icon/star.svg') }}" width="15" alt="star">
                                    <img src="{{ asset('frontend/images/icon/star-half.svg') }}" width="15" alt="star"> -->
                                </div>
                            </div>
                            <div class="user_comment">
                                <p>
                                    {{ $review->comment }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if (isset($checkReview))
                    <div class="write-review mt-4">
                        <div class="section_title mb-4">
                            <h3>Write your review</h3>
                        </div>
                        <div class="review_form">
                            <form action="{{ route('frontend.review.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="stars" id="stars" value="2">
                                <input type="hidden" name="ad_id" id="ad_id" value="{{ $ad->id }}">
                                <input type="hidden" name="order_id" id="order_id"
                                    value="{{ $ad->orderDetail->id ?? '' }}">
                                <div class="mb-4">
                                    <div id="rateYo"></div>
                                </div>
                                <div class="mb-4">
                                    <label for="comment" class="form-label">Message</label>
                                    <textarea name="comment" id="comment" cols="30" rows="7" class="form-control"
                                        placeholder="Enter your feedback" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- ============================== product review ================================== -->
    @if (isset($related_ad) && $related_ad->count() > 0)
        <!-- ============================== related product ================================== -->
        <div class="related_products new_arrivals mb-3">
            <div class="container">
                <div class="section_title mb-4">
                    <h3>Similar Products</h3>
                </div>
                <div class="swiper arrivals_products">
                    <div class="swiper-wrapper">
                        @foreach ($related_ad as $item)
                            <div class="swiper-slide">
                                @include('front.single_product', $item)
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
        <!-- ============================== related product ================================== -->
    @endif
@endsection


@push('js')
    <script src="{{ asset('front/assets/js/lg-thumbnail.umd.js') }}"></script>
    <script src="{{ asset('front/assets/js/lg-zoom.umd.js') }}"></script>
    <script src="{{ asset('front/assets/js/lightgallery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#rateYo").rateYo({
                starWidth: '30px',
                fullStar: true,
                mormalFill: 'yellow',
                ratedFill: 'orange',
                rating: 2,
                onSet: function(rating, rateYoInstance) {
                    $('#stars').val(rating);
                }
            });

            var avg_rate = "{{ $reviews->avg('stars') ?? 0 }}"
            $("#avg_rate").rateYo({
                starWidth: '20px',
                fullStar: true,
                mormalFill: 'yellow',
                ratedFill: 'orange',
                rating: avg_rate,
                readOnly: true


            });
        });
    </script>
    <script>
        $(document).ready(function() {
            new Swiper('.arrivals_products', {
                loop: false,
                slidesPerView: 4,
                paginationClickable: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                spaceBetween: 20,
                breakpoints: {
                    1400: {
                        slidesPerView: 4,
                        spaceBetween: 30
                    },
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    575: {
                        slidesPerView: 2,
                        spaceBetween: 10
                    },
                    500: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    },
                    0: {
                        slidesPerView: 1,
                        spaceBetween: 10
                    }
                }
            });

            // product gallery
            var swiper = new Swiper(".mySwiper", {
                spaceBetween: 12,
                freeMode: true,
                watchSlidesProgress: true,
                breakpoints: {
                    1024: {
                        slidesPerView: 6,
                    },
                    1: {
                        slidesPerView: 3,
                    },
                },
            });
            var swiper2 = new Swiper(".mySwiper2", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: swiper,
                },
            });
            lightGallery(document.getElementById('lightgallery'), {
                download: false,
                speed: 500,
                thumbnail: true,
                plugins: [lgZoom, lgThumbnail],
            });
        });

        $(document).ready(function() {
            // Decrease the quantity value by clicking the minus button
            $('.incrementBtnL').click(function() {
                let quantityInput = $(this).prev('input');
                let currentValue = parseInt(quantityInput.val());
                if (currentValue > 1) {
                    quantityInput.val(currentValue - 1);
                }
            });
            // Increase the quantity value by clicking the plus button
            $('.incrementBtnR').click(function() {
                let quantityInput = $(this).next('input');
                let currentValue = parseInt(quantityInput.val());
                let max = '{{ $ad->qty }}';
                if (currentValue < max) {
                    quantityInput.val(parseInt(quantityInput.val()) + 1);
                } else {
                    toastr.error('No more stock for now.');
                }
            });
        });

        function attrPriceCal() {
            let product_price = Number('{{ $ad->discount ? discount_cal($ad->price, $ad->discount) : $ad->price }}');

            $('.selectSize:checked').each(function() {
                let price = Number($(this).data('price'));

                if ($(this).is(':checked')) {
                    product_price += price;
                } else {
                    product_price -= price;
                }
            });

            $('#product_price').text(product_price);
        }
        attrPriceCal()

        $('.selectSize').on('change', function() {
            attrPriceCal()
        });


        function addToCart(id, type) {
            let user_id = '{{ Auth::user()->id ?? '' }}';
            let ad_user_id = '{{ $ad->user_id ?? '' }}';
            let seller_mode = '{{ is_seller() }}';
            if (user_id == ad_user_id) {
                toastr.error('You cannot buy your own product!');
                return false;
            }
            if (seller_mode) {
                toastr.error('Please switch to buyer mode to purchase!');
                return false;
            }

            let quantity = $('#selectQuantity').val();
            let product_price = Number($('#product_price').text());
            let data = $('.selectSize:checked').map(function() {
                return {
                    attr_name: $(this).data('attr_name'),
                    name: $(this).val(),
                    price: $(this).data('price')
                };
            }).toArray();
            const attr = data.reduce((acc, curr) => {
                const {
                    attr_name,
                    ...rest
                } = curr;
                if (!acc[attr_name]) {
                    acc[attr_name] = [rest];
                } else {
                    acc[attr_name].push(rest);
                }
                return acc;
            }, {});


            $.ajax({
                url: '{{ route('frontend.cart.add') }}',
                method: 'GET',
                data: {
                    'id': id,
                    'quantity': quantity,
                    'attr': attr,
                    'type': type,
                    'product_price': product_price,
                },
                beforeSend: function(data) {
                    $('.loading').attr('disabled', true);
                    $('.' + type).html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                        )
                },
                success: function(data) {
                    console.log(data)
                    $('.cart_count').text(data.cart_count);
                    if (type == 'checkout') {
                        window.location.href = '{{ route('frontend.cart.index') }}';
                    } else {
                        toastr.success('Cart added successfully.');
                    }
                    if (data.status == true) {
                        $('.loading').attr('disabled', true);
                        $('.cart').html('Add to Cart');
                        $('.checkout').html('Buy Now');
                    }
                }
            });

        }
    </script>
@endpush
