<div class="col-sm-12 col-md-4 mb-2">
    <div class="product_wrapper">
        <div class="cards cards--one">
            <a href="{{ route('frontend.ad.details', $ad->slug) }}" class="cards__img-wrapper">
                <img src="{{ getPhoto($ad->thumbnail) }}" alt="card-img" class="img-fluid">
            </a>
            <div class="cards__info">
                @auth()
                    <h6 class="cards__location card_heart_icon text--body-4">
                        <div class="form-check">
                            <input class="form-check-input" onchange="addToWishList(event)"
                                {{ checkWishList($ad->id) ? 'checked' : '' }} type="checkbox" value="{{ $ad->id }}"
                                id="deal{{ $ad->id }}">
                            <label class="form-check-label" for="deal{{ $ad->id }}"></label>
                        </div>
                    </h6>
                @endauth

                @guest()
                    <h6 class="cards__location card_heart_icon text--body-4">
                        <div class="form-check" type="checkbox" data-bs-toggle="modal" data-bs-target="#loginModal"
                            name="deal">
                            <input class="form-check-input d-none" disabled>
                            <label class="form-check-label" for="deal"></label>
                        </div>
                    </h6>
                @endguest
                <div class="cards__info-top">
                    <h5>
                        <a href="{{ route('frontend.ad.details', $ad->slug) }}"
                            class="text--body-3-600 cards__caption-title">
                            {{ Str::limit($ad->title, 16, $end = '...') }}
                        </a>
                    </h5>
                    <h6 style="min-height: 16px;">{{ $ad->brand->name ?? 'Nick' }}</h6>
                    <div class="price">
                        @if ($ad->price)
                            @if ($ad->is_smart_price)
                                <p>{{ changeCurrency($ad->smart_price) }}<del>{{ changeCurrency($ad->price) }}</del>
                                </p>
                            @else
                                <p>{{ changeCurrency($ad->price) }}</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
