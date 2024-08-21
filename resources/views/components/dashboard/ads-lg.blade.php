<div class="body-item body-item--lg">
    <div class="card-edit">
        <a href="{{ route('frontend.ad.details', $ad->slug) }}" class="card-edit__item product-name">
            <div class="img">
                <img src="{{ getPhoto($ad->thumbnail) }}" alt="product" />
            </div>
            <h2 class="text--body-4">
                {{ \Illuminate\Support\Str::limit($ad->title, 25, $end = '...') }}
            </h2>
        </a>
        <div class="card-edit__item product-date">
            @if ($ad->status == 'active')
                @if ($ad->validity > now())
                    <span class="text--body-4"> {{ now()->diffInDays(Carbon\Carbon::parse($ad->validity)) + 1 }} Days
                    </span>
                @else
                    <span class="text--body-4">
                        <a href="{{ route('frontend.reactiveAd', $ad->slug) }}"
                            onclick="return confirm('Are you want to reactive? It will cost a coupon.')"
                            class="btn btn-sm btn-danger"> {{ __('Reactive') }}</a>
                    </span>
                @endif
            @else
                -
            @endif
        </div>
        <div class="card-edit__item product-price">
            <span class="text--body-4">
                {{ changeCurrency($ad->price) }}
            </span>
        </div>
        @if (!request()->routeIs('frontend.favourites'))
            <div class="card-edit__item product-status">
                <x-frontend.dashboard-ad-status :ad="$ad" />
            </div>
        @else
            <div class="card-edit__item product-status">
                {{ $ad->category->name }}
            </div>
        @endif
        <div class="card-edit__item product-action">
            {{ $slot }}
        </div>
    </div>
</div>
