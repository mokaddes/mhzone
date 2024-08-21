<div class="tag-status tag-status--active">
    <span class="icon">
        @if ($ad->status === 'active')
            @if ($ad->validity < now())
                <x-svg.cross-icon stroke="#dc3545" />
            @else
                <x-svg.check-icon width="18" height="18" />
            @endif
        @elseif($ad->status === 'sold')
            <x-svg.cross-icon stroke="#dc3545" />
        @elseif($ad->status === 'declined')
            <x-svg.cross-icon stroke="#dc3545" />
        @else
            <x-svg.pending-icon />
        @endif
    </span>
    <h6 class="text--body-3">
        @if ($ad->status === 'sold')
            <span class="text-danger">{{ $ad->status }}</span>
        @elseif($ad->status === 'pending')
            <span class="text-warning">{{ $ad->status }}</span>
        @elseif($ad->status === 'declined')
            <span class="text-danger">{{ $ad->status }}</span>
        @else
            @if ($ad->validity < now())
                <span class="text-danger">{{ __('Expired') }}</span>
            @else
                <span>{{ $ad->status }}</span>
            @endif
        @endif
    </h6>
</div>
