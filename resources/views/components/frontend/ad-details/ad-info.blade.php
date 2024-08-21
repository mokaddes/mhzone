<div class="product-item__ads-info">
    <h2 class="text--heading-2 title align-items-center">
        {{ $ad->title }} 
        <a class="float-end" href="#">
            <svg class="heart ListingPage-Likes-Icon" width="25px" height="25px" viewBox="0 0 26 23" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.2744 2.53035C9.46658 -0.277452 4.91366 -0.277452 2.10585 2.53035C-0.701951 5.33816 -0.701951 9.89108 2.10585 12.6989L12 22.593H14L23.8941 12.6989C26.702 9.89108 26.702 5.33816 23.8941 2.53035C21.0863 -0.277452 16.5334 -0.277452 13.7256 2.53035L13 3.25596L12.2744 2.53035ZM13.1716 20.593L22.4799 11.2847C24.5067 9.25792 24.5067 5.97132 22.4799 3.94457C20.4532 1.91781 17.1666 1.91781 15.1398 3.94457L13.5 5.58439H13H12.5L10.8602 3.94457C8.83342 1.91781 5.54682 1.91781 3.52007 3.94457C1.49331 5.97132 1.49331 9.25792 3.52007 11.2847L12.8284 20.593H13.1716Z" fill="black"></path></svg>
            <span>167</span>
        </a>
    </h2>

    <ul class="post-details">
        <li class="post-details__item">
            <span class="icon">
                <x-svg.location-icon />
            </span>
            <p class="text--body-3">{{ $ad->region }} {{ $ad->region ? ', ': '' }} {{ $ad->country }}</p>
        </li>
        <li class="post-details__item">
            <span class="icon">
                <x-svg.clock-icon width="24" height="24" stroke="#767E94" />
            </span>
            <p class="text--body-3">{{ \Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</p>
        </li>
        <li class="post-details__item">
            <span class="icon">
                <x-svg.eye-icon stroke="#767E94" />
            </span>
            <p class="text--body-3">{{ $ad->total_views }} {{ __('viewed') }}</p>
        </li>
    </ul>
</div>
