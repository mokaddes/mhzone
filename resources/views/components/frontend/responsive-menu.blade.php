<div class="menu--sm mobile-menu">
    <!-- Head -->
    <div class="mobile-menu__header">
        <!-- brand -->
        <div class="mobile-menu__brand">
            <a href="{{ route('frontend.index') }}">
                <img src="{{ $settings->logo_image_url }}" alt="brand-logo">
            </a>
            <div class="close">
                <span>
                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 5.08325L15.6066 15.6899" stroke="#191F33" stroke-width="1.9375"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.99999 15.9167L15.6066 5.31015" stroke="#191F33" stroke-width="1.9375"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
            </div>
        </div>
        <!-- <div class="mobile-menu__search">
                    <form action="{{ route('frontend.adlist.search') }}" method="GET">
                        <div class="input-field">
                            <input type="text" placeholder="{{ __('ads title keyword') }}..." name="keyword">
                            <button class="icon icon-search">
                            <x-svg.search-icon />
                            </button>
                        </div>
                    </form>
                </div> -->
        <!-- <div class="mobile-menu__body">
                    <ul>
                        <li class="menu--sm__item">
                            <a href="{{ route('frontend.index') }}" class="menu--sm__link">{{ __('home') }}</a>
                        </li>
                        <li class="menu--sm__item">
                            <a href="#" class="menu--sm__link">
                                {{ __('all categories') }}
                                <span class="icon">
                                    <x-svg.category-arrow-icon />
                                </span>
                            </a>
                            @if (isset($footer_categories) && count($footer_categories))
<ul class="menu--sm-dropdown">
                                @foreach ($footer_categories as $category)
<li class="menu--sm-dropdown__item">
                                    <a href="javascript:void(0)"
                                        onclick="adFilterFunctionTwo('{{ $category->slug }}')"
                                        class="menu--sm-dropdown__link">
                                        {{ $category->name }}
                                    </a>
                                </li>
@endforeach
                            </ul>
@endif
                        </li>
                        <li class="menu--sm__item">
                            <a href="{{ route('frontend.adlist') }}" class="menu--sm__link">{{ __('ads') }}</a>
                        </li>
                        @if ($blog_enable)
<li class="menu--sm__item">
                            <a href="{{ route('frontend.blog') }}" class="menu--sm__link">{{ __('blog') }}</a>
                        </li>
@endif
                        @if ($priceplan_enable)
<li class="menu--sm__item">
                            <a href="{{ route('frontend.priceplan') }}" class="menu--sm__link">{{ __('pricing') }}</a>
                        </li>
@endif
                    </ul>
                </div> -->
        <!-- login user menu -->
        @if (auth('user')->check())
        <div class="login_user_menu">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="userDropdown">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#usercollapseOne" aria-expanded="true" aria-controls="usercollapseOne">
                            <img src="{{ auth('user')->user()->image_url }}" class="rounded-circle me-2"
                                style="width:50px; height:50px; ">
                            My Account
                        </button>
                    </h2>
                    <div id="usercollapseOne" class="accordion-collapse collapse show" aria-labelledby="userDropdown"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                <li><a href="{{ route('frontend.dashboard') }}"
                                        class="{{ request()->routeIs('frontend.dashboard') ? 'active' : '' }}">DASHBOARD</a>
                                </li>
                                <li><a href="{{ route('frontend.message') }}"
                                        class="{{ request()->routeIs('frontend.message') ? 'active' : '' }}">MESSAGES</a>
                                </li>
                                <li><a href="{{ route('frontend.adds') }}"
                                        class="{{ request()->routeIs('frontend.adds') ? 'active' : '' }}">MY
                                        ITEMS</a></li>
                                @if (session('user_plan') && session('user_plan')->ad_limit > 0)
                                <li><a href="{{ route('frontend.post') }}"
                                        class="{{ request()->routeIs('frontend.post') ? 'active' : '' }}">POST
                                        ADS</a></li>
                                @endif
                                <li><a href="#">TRANSACTIONS</a></li>
                                <li><a href="#">FEEDBACK</a></li>
                                <li><a href="{{ route('frontend.account-setting') }}"
                                        class="{{ request()->routeIs('frontend.account-setting') ? 'active' : '' }}">MY
                                        PROFILE</a></li>
                                <li><a href="{{ route('frontend.my-addresses') }}"
                                        class="{{ request()->routeIs('frontend.my-addresses') ? 'active' : '' }}">MY
                                        ADDRESSES</a></li>
                                <li><a href="{{ route('frontend.my-sizes') }}"
                                        class="{{ request()->routeIs('frontend.my-sizes') ? 'active' : '' }}">MY
                                        SIZES</a></li>
                                <li><a href="{{ route('frontend.settings') }}"
                                        class="{{ request()->routeIs('frontend.settings') ? 'active' : '' }}">SETTINGS</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- categories -->
        <div class="mobile_menu">
            <ul>
                @foreach ($categories as $topCategory)
                @if ($topCategory->subcategories->count() > 0)
                <li class="accordion-header" id="headingTwo_{{ $topCategory->id }}">
                    <a href="{{ route('frontend.adlist.search', ['category' => $topCategory->slug]) }}"
                        class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo_{{ $topCategory->id }}" aria-expanded="false"
                        aria-controls="collapseTwo_{{ $topCategory->id }}">{{ __(str_replace(' ', '_',
                        strtolower($topCategory->name))) }}</a>
                    <div id="collapseTwo_{{ $topCategory->id }}" class="accordion-collapse collapse"
                        aria-labelledby="headingTwo_{{ $topCategory->id }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mobile_category">
                                <ul>
                                    @foreach ($topCategory->subcategories as $subcategory)
                                    @if ($subcategory->childCategory->count() > 0)
                                    <li class="accordion-header" id="headingThree_{{ $subcategory->id }}">
                                        <a href="#" class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree_{{ $subcategory->id }}" aria-expanded="false"
                                            aria-controls="collapseThree_{{ $subcategory->id }}">{{ __(str_replace(' ',
                                            '_', strtolower($subcategory->name))) }}</a>
                                        <div id="collapseThree_{{ $subcategory->id }}"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="headingThree_{{ $subcategory->id }}"
                                            data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="subsubcategory mobile_category">
                                                    <ul>
                                                        @foreach ($subcategory->childCategory as $childCategory)
                                                        <li><a class="dropdown-item" href="{{ route('frontend.adlist.search', ['childcategory[]' => $childCategory->slug]) }}">
                                                                {{ __($childCategory->name) }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @else
                                    <li><a class="dropdown-item"
                                            href="{{ route('frontend.adlist.search', ['subcategory' => $subcategory->slug]) }}">{{
                                            __($subcategory->name) }}</a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                @else
                <li><a href="{{ route('frontend.adlist.search', ['category' => $topCategory->slug]) }}">{{
                        __(($topCategory->name)) }}</a>
                </li>
                @endif
                @endforeach
            </ul>

            <!-- menu -->
            <div class="offcanvas_mobile_menu">
                <a href="{{ route('frontend.contact') }}">{{__('help')}}</a>
                <a href="{{ route('frontend.about') }}">{{__('about')}}</a>
                <a href="{{ route('frontend.terms') }}">{{__('terms_condition')}}</a>
                <a href="{{ route('frontend.privacy') }}">{{__('privacy_policy')}}</a>
            </div>


            {{-- language --}}
            <div class="d-block d-lg-none ms-3">
                <x-frontend.language-switcher />
            </div>

        </div>
        <!-- categories -->
    </div>
    <!-- footer  -->
    {{--
    <div class="mobile-menu__footer ">
        @if (auth('user')->check())
        <div class="mobile-menu__footer ">
            <div class="mobile-menu-user-wrap">
                <div class="mobile-menu-user-left">
                    <div class="mobile-menu-user">
                        <img src="{{ auth('user')->user()->image_url }}" alt="">
                    </div>
                    <div class="mobile-menu-user-data">
                        <h5>{{ auth('user')->user()->name }}</h5>
                        <p>{{ auth('user')->user()->username }}</p>
                    </div>
                </div>
                <div class="mobile-menu-user-right">
                    <a class="sign-out" href="#"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <img src="{{ asset('frontend') }}/images/svg/SignOut.svg" alt="">
                    </a>
                    <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="d-flex align-items-center">
            <a href="{{ route('users.login') }}" class="btn mr-3 login_required">
                <span class="icon--left">
                    <x-svg.image-select-icon />
                </span>
                {{ __('post ads') }}
            </a>
            <a href="{{ route('users.login') }}" class="btn btn--bg ">{{ __('sign in') }}</a>
        </div>
        @endif
    </div>
    --}}
</div>
