<a href="{{ route('frontend.ad.details', $ad->slug) }}" class="edit-dropdown__link">
    <span class="icon">
        <x-svg.eye-icon stroke="currentColor" width="20" height="20" />
    </span>
    <h5 class="text--body-4">{{ __('view ads details') }}</h5>
</a>
