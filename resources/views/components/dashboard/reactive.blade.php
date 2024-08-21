<a href="{{ route('frontend.reactiveAd', $ad->slug) }}" onclick="return confirm('Do you want to reactive? It will cost a coupon.')" class="edit-dropdown__link">
    <span class="icon">
        <x-svg.check-icon width="18" height="18" />
    </span>
    <h5 class="text--body-4">{{ __('Re-active') }}</h5>
</a>
