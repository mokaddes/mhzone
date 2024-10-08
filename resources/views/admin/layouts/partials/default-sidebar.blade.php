<aside id="sidebar" class="main-sidebar sidebar-dark-primary elevation-4">
    {{-- style="background-color: {{ $setting->dark_mode ? '' : $setting->sidebar_color }}"> --}}
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ getPhoto($setting->favicon_image) }}" alt="{{ __('Logo') }}" class="elevation-3">
        {{-- <span class="brand-text font-weight-light">{{ config('app.name') }}</span> --}}
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-nav-wrapper">
            <!-- Sidebar Menu -->
            <nav class="sidebar-main-nav mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                    data-accordion="false">
                    @if ($user->can('dashboard.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('admin.dashboard') ? true : false" route="admin.dashboard" icon="fas fa-tachometer-alt">
                            {{ __('Dashboard') }}
                        </x-admin.sidebar-list>
                    @endif
                    <li class="nav-header">{{ __('Customer') }}</li>
                    {{-- @if (Module::collections()->has('Customer') && userCan('customer.view')) --}}
                    @if (userCan('module.customer.index'))
                        <li class="nav-item">
                            <a href="{{ route('module.customer.index') }}"
                                class="nav-link {{ Route::is('module.customer.*') ? ' active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>{{ __('Customer') }}</p>
                            </a>
                        </li>
                        @endif
                    {{-- @endif --}}

                    {{-- @if (Module::collections()->has('Plan') && userCan('plan.view') && $priceplan_enable)
                        <x-sidebar-list :linkActive="Route::is('module.plan.index') || Route::is('module.plan.create') ? true : false" route="module.plan.index" icon="fas fa-credit-card">
                            {{ __('pricing plan') }}
                        </x-sidebar-list>
                    @endif --}}
                    {{-- @if (userCan('report.index') || userCan('report.view'))
                        <!-- <x-sidebar-list :linkActive="Route::is('report.index') ? true : false" route="report.index" icon="fas fa-file">
                            {{ __('Seller Report') }}
                        </x-sidebar-list> -->
                    @endif --}}
                    <li class="nav-header">{{ __('Shop') }}</li>
                    @if (Module::collections()->has('Ad') && userCan('ad.view'))
                        <x-sidebar-list :linkActive="Route::is('module.ad.*') ? true : false" route="module.ad.index" icon="fas fa-store">
                            {{ __('All Products') }}
                        </x-sidebar-list>
                    @endif
                    @if (userCan('admin.orders.index'))
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.index') }}"
                                class="nav-link @if (request()->routeIs('admin.orders.*')) active @endif">
                                <i class="nav-icon fa fa-shopping-cart"></i>
                                <p>{{ __('Orders') }}</p>
                            </a>
                        </li>
                    @endif
                    @if (userCan('transactions'))
                        <li class="nav-item">
                            <a href="{{ route('transactions') }}"
                                class="nav-link @if (request()->routeIs('transactions')) active @endif @yield('transaction_invoice')">
                                <i class="nav-icon fa fa-credit-card"></i>
                                <p>{{ __('Transactions') }}</p>
                            </a>
                        </li>
                    @endif
                    @if (userCan('department.index'))
                        <li class="nav-item">
                            <a href="{{ route('department.index') }}"
                                class="nav-link  @if (request()->routeIs('department.*')) active @endif">
                                <i class="nav-icon fa fa-bars"></i>
                                <p>{{ __('Department') }}</p>
                            </a>
                        </li>
                    @endif
                    @if (Module::collections()->has('Category') && (userCan('category.view') || userCan('subcategory.view')))
                        <x-admin.sidebar-list :linkActive="Route::is('module.category.*') || Route::is('module.subcategory.*') ? true : false" route="module.category.index" icon="fas fa-th">
                            {{ __('Category') }}
                        </x-admin.sidebar-list>
                    @endif
                    <!-- <li class="nav-item">
                        <a href="{{ route('coupons.index') }}"
                            class="nav-link  @if (request()->routeIs('coupons.*')) active @endif">
                            <i class="nav-icon fa fa-bars"></i>
                            <p>{{ __('Coupon') }}</p>
                        </a>
                    </li> -->
                    {{-- @if (userCan('size.index') || userCan('size.update'))
                        <li class="nav-item">
                            <a href="{{ route('size.index') }}"
                                class="nav-link  @if (request()->routeIs('size.*')) active @endif">
                                <i class="nav-icon fas fa-ruler"></i>
                                <p>{{ __('Size') }}</p>
                            </a>
                        </li>
                    @endif --}}

                    {{-- @if (userCan('module.coupon.index'))
                        <li class="nav-item">
                            <a href="{{ route('module.coupon.index') }}"
                                class="nav-link  @if (request()->routeIs('module.coupon.*')) active @endif">
                                <i class="nav-icon fa fa-shopping-basket"></i>
                                <p>{{ __('Coupon') }}</p>
                            </a>
                        </li>
                    @endif --}}

                    {{-- @if (userCan('color.index'))
                        <li class="nav-item">
                            <a href="{{ route('color.index') }}"
                                class="nav-link @if (request()->routeIs('color.*')) active @endif">
                                <i class="nav-icon fas fa-palette"></i>
                                <p>{{ __('Color') }}</p>
                            </a>
                        </li>
                    @endif --}}

                    {{-- @if (Module::collections()->has('CustomField') && userCan('custom-field.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.custom.field.*') ? true : false" route="module.custom.field.index" icon="fas fa-edit">
                            {{ __('custom_field') }}
                        </x-admin.sidebar-list>
                    @endif --}}

                    {{-- @if (Module::collections()->has('Location'))
                        @if (userCan('city.view') || userCan('town.view'))
                            <x-sidebar-dropdown :linkActive="Route::is('module.city.*') || Route::is('module.town.*') ? true : false" :subLinkActive="Route::is('module.city.*') || Route::is('module.town.*') ? true : false" icon="fas fa-location-arrow">
                                @slot('title')
                                    {{ __('Location') }}
                                @endslot

                                @if (userCan('city.view'))
                                    <ul class="nav nav-treeview">
                                        <x-sidebar-list :linkActive="Route::is('module.city.*') ? true : false" route="module.city.index"
                                            icon="fas fa-circle">
                                            {{ __('City') }}
                                        </x-sidebar-list>
                                    </ul>
                                @endif
                                @if (userCan('town.view'))
                                    <ul class="nav nav-treeview">
                                        <x-sidebar-list :linkActive="Route::is('module.town.*') ? true : false" route="module.town.index"
                                            icon="fas fa-circle">
                                            {{ __('Town') }}
                                        </x-sidebar-list>
                                    </ul>
                                @endif

                            </x-sidebar-dropdown>
                        @endif
                    @endif --}}
                    {{-- @if (Module::collections()->has('Brand') && userCan('brand.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.brand.*') ? true : false" route="module.brand.index" icon="fas fa-award">
                            {{ __('Brand') }}
                        </x-admin.sidebar-list>
                    @endif --}}

                    {{-- @if (Module::collections()->has('Map') && userCan('map.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.map.*') ? true : false" route="module.map.index" icon="fas fa-map-marker-alt">
                            {{ __('map') }}
                        </x-admin.sidebar-list>
                    @endif --}}

                    <li class="nav-header">{{ __('Others') }}</li>

                    @if ($user->can('admin.view'))
                        <x-admin.sidebar-list :linkActive="Route::is('user.*') || Route::is('role.*') ? true : false" route="user.index" icon="fas fa-users">
                            {{ __('Admin Role Manage') }}
                        </x-admin.sidebar-list>
                    @endif
                    {{-- Newsletter Subscription --}}
                    @if (Module::collections()->has('Newsletter') && $newsletter_enable)
                        @if (userCan('newsletter.view') || userCan('newsletter.mailsend'))
                            <!-- <x-sidebar-dropdown :linkActive="Route::is('module.newsletter.*') ? true : false" :subLinkActive="Route::is('module.newsletter.*') ? true : false" icon="fas fa-envelope">
                                @slot('title')
    {{ __('Newsletter') }}
@endslot

                                @if (userCan('newsletter.view'))
<ul class="nav nav-treeview">
                                        <x-sidebar-list :linkActive="Route::is('module.newsletter.index') ? true : false" route="module.newsletter.index"
                                            icon="fas fa-circle">
                                            {{ __('Emails') }}
                                        </x-sidebar-list>
                                    </ul>
@endif
                                @if (userCan('newsletter.mailsend'))
<ul class="nav nav-treeview">
                                        <x-sidebar-list :linkActive="Route::is('module.newsletter.send_mail') ? true : false" route="module.newsletter.send_mail"
                                            icon="fas fa-circle">
                                            {{ __('Send mail') }}
                                        </x-sidebar-list>
                                    </ul>
@endif

                            </x-sidebar-dropdown> -->
                        @endif
                    @endif

                    {{-- Blog and Tag --}}
                    {{-- @if (Module::collections()->has('Blog'))
                        @if ($blog_enable)
                            @if (userCan('post.view') || userCan('postcategory.view'))
                                <x-sidebar-dropdown :linkActive="Route::is('module.post.*') || Route::is('module.postcategory.*')
                                    ? true
                                    : false" :subLinkActive="Route::is('module.post.*') || Route::is('module.postcategory.*')
                                    ? true
                                    : false" icon="fas fa-blog">
                                    @slot('title')
                                        {{ __('blog') }}
                                    @endslot

                                    @if (userCan('postcategory.view'))
                                        <ul class="nav nav-treeview">
                                            <x-sidebar-list :linkActive="Route::is('module.postcategory.*') ? true : false" route="module.postcategory.index"
                                                icon="fas fa-circle">
                                                {{ __('post category') }}
                                            </x-sidebar-list>
                                        </ul>
                                    @endif
                                    @if (userCan('post.view'))
                                        <ul class="nav nav-treeview">
                                            <x-sidebar-list :linkActive="Route::is('module.post.*') ? true : false" route="module.post.index"
                                                icon="fas fa-circle">
                                                {{ __('post') }}
                                            </x-sidebar-list>
                                        </ul>
                                    @endif
                                </x-sidebar-dropdown>
                            @endif
                        @endif
                    @endif --}}

                    {{-- @if (Module::collections()->has('Testimonial') && userCan('testimonial.view') && $testimonial_enable)
                        <x-admin.sidebar-list :linkActive="Route::is('module.testimonial.*') ? true : false" route="module.testimonial.index" icon="fas fa-comment">
                            {{ __('testimonial') }}
                        </x-admin.sidebar-list>
                    @endif --}}

                    {{-- @if (Module::collections()->has('Contact') && userCan('contact.view') && $contact_enable) --}}
                    @if (userCan('module.contact.index'))
                        <x-admin.sidebar-list :linkActive="Route::is('module.contact.*') ? true : false" route="module.contact.index" icon="fas fa-address-book">
                            {{ __('Contact') }}
                        </x-admin.sidebar-list>
                    @endif    
                    {{-- @endif --}}
                    @if (userCan('faq.view') && $faq_enable)
                        <x-admin.sidebar-list :linkActive="Route::is('module.faq.*') ? true : false" route="module.faq.index" icon="fas fa-question">
                            {{ __('Faq') }}
                        </x-admin.sidebar-list>
                    @endif

                    {{-- @if ($settings->ads_admin_approval)
                        <form action="{{ route('module.ad.index') }}" method="GET" id="pending_ads_form">
                            <input name="filter_by" type="text" value="pending" hidden>
                            <input name="sort_by" type="text" value="latest" hidden>
                        </form>
                        <button onclick="$('#pending_ads_form').submit();" type="button"
                            class="btn btn-primary mt-4 mx-3 text-white mb-3">
                            {{ __('pending ads') }}
                        </button>
                    @endif --}}
                </ul>
            </nav>
            <!-- Sidebar Menu -->
            <nav class="mt-2 nav-footer" style="border-top: 1px solid gray; padding-top: 20px;">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a target="_blank" href="/" class="nav-link"
                            style="background-color: #007bff; color: #fff;">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>{{ __('Visit Website') }}</p>
                        </a>
                    </li>
                    @if ($user->can('setting.view') || $user->can('setting.update'))
                        <x-admin.sidebar-list :linkActive="request()->is('admin/settings/*') ? true : false" route="settings.general" icon="fas fa-cog">
                            {{ __('Settings') }}
                        </x-admin.sidebar-list>
                    @endif
                    <li class="nav-item">
                        <a href="javascript:void(0" class="nav-link"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>{{ __('Logout') }} </p>
                        </a>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                            class="d-none invisible">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
