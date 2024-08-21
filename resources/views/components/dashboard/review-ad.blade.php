<form action="{{ route('frontend.myRevirw',['ad'=>$ad->id]) }}" method="post" class="edit-dropdown__link">
    @csrf
    <button class="d-flex align-items-center">
        <span class="icon">
            <x-svg.eye-icon />
        </span>
        <h5 class="text--body-4">{{ __('review') }}</h5>
    </button>
</form>
