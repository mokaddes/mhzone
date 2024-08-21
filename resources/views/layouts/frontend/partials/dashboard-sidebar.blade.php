<div class="user_sidebar">
    <ul>
        @if (isset(Auth::user()->coupons) && Auth::user()->coupons > 0)
            <li><a href="{{ route('frontend.post') }}"
                    class="{{ request()->routeIs('frontend.post') ? 'active' : '' }}">{{ __('post_ads') }}</a></li>
        @else
            <li><a href="{{ route('frontend.coupons') }}">{{ __('post ads') }}</a></li>
        @endif
        <li>
            <a href="{{ route('frontend.dashboard') }}"
                class="{{ request()->routeIs('frontend.dashboard') ? 'active' : '' }}">{{ __('overview') }}</a>
        </li>
        <li>
            <a href="{{ route('frontend.adds') }}"
                class="{{ request()->routeIs('frontend.adds') ? 'active' : '' }}">{{ __('my_itmes') }}
            </a>
        </li>
        <li>
            <a href="{{ route('frontend.coupons') }}"
                class="{{ request()->routeIs('frontend.coupons') ? 'active' : '' }}">{{ __('my_coupons') }}</a>
        </li>
        <li><a href="{{ route('frontend.account-setting') }}"
                class="{{ request()->routeIs('frontend.account-setting') ? 'active' : '' }}">{{ __('my_profile') }}</a>
        </li>
        <li><a href="{{ route('frontend.message') }}"
                class="{{ request()->routeIs('frontend.message') ? 'active' : '' }}">{{ __('message') }}</a>
        </li>
        <li><a class="{{ request()->routeIs('frontend.favourites') ? 'active' : '' }}"
                href="{{ route('frontend.favourites') }}">{{ __('wishlist') }}</a></li>
        <li><a class="{{ request()->routeIs('frontend.myTransaction') ? 'active' : '' }}"
                href="{{ route('frontend.myTransaction') }}">{{ __('transactions') }}</a></li>
        <li>
            <a href="javascript:;" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                {{ __('sign out') }}
            </a>
            <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>
