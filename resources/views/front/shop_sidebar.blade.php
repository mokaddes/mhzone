<!-- shop for -->

@if(Route::is('frontend.seller.shop') || Route::is('frontend.user.myShop') )

    <div class="shop_wrap mb-4 d-block d-xl-none">
        <div class="seller-profile position-relative">
            <div class="text-center">
                <div class="seller-img profile_logo mb-1">
                    <img src="{{ asset($user->image ?? 'front/assets/images/profile.png') }}" width="50"
                         alt="user name">
                </div>
                <div class="seller-info">
                    <h4 class="mb-2">{{ $user-> name ?? 'John Doe' }}</h4>
                    <p>
                        <i class="la la-phone"></i>
                        <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                    </p>
                    <p>
                        <i class="la la-envelope"></i>
                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endif
<input type="hidden" name="keyword" id="keywordInput" value="{{ request('keyword') }}">
<div class="shop_wrap mb-4">
    <div class="shop-title mb-3">
        <h3>Shop For</h3>
    </div>
    <div class="shop-filter-type">
        <div class="filter_button">
            @foreach($departments as $department)
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="department" value="{{$department->slug}}"
                           id="desk_{{$department->slug}}"
                           onchange="changeFilter('{{ $department->slug }}')" {{ request('department') == $department->slug ? 'checked' : '' }} >
                    <label class="form-check-label" for="desk_{{$department->slug}}">
                        {{ $department->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- shop category -->
@if(isset($categories) && $categories->count() > 0)
    <div class="shop_wrap mb-4">
        <div class="shop-title mb-3">
            <h3>Category</h3>
        </div>
        <div class="shop-filter-type">
            <div class="filter_button">
                @foreach($categories as $category)
                    <div class="form-check">
                        <input class="form-check-input cat_input_check {{ $category->department->slug }}" type="radio"
                               name="category"
                               data-department="{{ $category->department->slug }}" value="{{ $category->slug }}"
                               id="desk_{{$category->slug}}{{$category->id}}" {{ request('category') == $category->slug ? 'checked' : '' }} >
                        <label class="form-check-label" for="desk_{{$category->slug}}{{$category->id}}">
                            {{ $category->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

@if(isset($subcategories) && $subcategories->count() > 0)
    <div class="shop_wrap mb-4">
        <div class="shop-title mb-3">
            <h3>Subcategories</h3>
        </div>
        <div class="shop-filter-type">
            <div class="filter_button">
                @foreach($subcategories as $subcategory)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="subcategory[]"
                               value="{{ $subcategory->slug }}" onchange="changeFilter()"
                               id="desk_{{$subcategory->slug}}{{$subcategory->id}}" {{ request()->has('subcategory') && in_array($subcategory->slug , request('subcategory')) ? 'checked' : '' }} >
                        <label class="form-check-label" for="desk_{{$subcategory->slug}}{{$subcategory->id}}">
                            {{ $subcategory->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif


<!-- shop price -->
<div class="shop_wrap mb-4">
    <div class="shop-title mb-3">
        <h3>Price</h3>
    </div>
    <div class="shop-filter-type">
        <div class="shop_price">
            <div class="input-group">
                <input type="number" name="min_price" id="from_price" value="0" class="form-control" placeholder="Min" required=""
                       autocomplete="off" value="{{ request('min_price') }}">
                <input type="number" name="max_price" id="to_price" class="form-control" placeholder="Max" required=""
                       value="{{ request('max_price') }}">
                <button type="submit" class="btn btn-primary" id="apply_btn">Apply</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="sort" id="sortInput" value="{{ request('sort') }}">
<input type="hidden" class="session_cat" value="{{ request('department') }}">
@if(Route::is('frontend.shop'))
    <input type="hidden" class="action_url" value="{{ url('/shop') }}/">
@elseif(Route::is('frontend.seller.shop'))
    <input type="hidden" class="action_url" value="{{ url('/seller/shop') }}/{{ $seller_shop->slug }}/">
@else
    <input type="hidden" class="action_url" value="{{ url('/dashboard/my-shop') }}/">
@endif


