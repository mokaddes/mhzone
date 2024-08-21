<div class="card h-100 product_wrapper border-0 bg-none mb-3">
    <div class="card-body p-0 border-0">
        <div class="d-flex justify-content-between align-items-center p-3">
            <div class="category">
                @if (Route::is('frontend.user.myAds'))
                    <span>In Stock: <strong>{{ $item->qty }}</strong></span>
                    <br>
                    <small
                        class="badge {{ $item->status == 'active' ? 'bg-success' : 'bg-danger' }} text-white text-center">{{ ucfirst($item->status) }}</small>
                @else
                    <span>{{ $item->category->name }}</span>
                @endif
            </div>
            <div class="favorite_item">
                @if (Route::is('frontend.user.myAds'))
                    <div class="product_edit dropup-center dropup">
                        <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('front/assets/images/icons/list.svg') }}" alt="">
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('frontend.post.edit', $item->slug) }}">Edit</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('frontend.ad.details', $item->slug) }}">View</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('frontend.post.delete', $item->id) }}"
                                    onclick="return confirm('Are you sure! You went to delete this post..')">Delete</a>
                            </li>
                        </ul>
                    </div>
                @elseif(!Route::is('frontend.user.wishlist'))
                    <div class="form-check">
                        <input class="form-check-input" name="favorite" type="checkbox"
                            id="favorite_{{ $item->id }}"
                            onchange="AddWishlist({{ $item->id }}, {{ Auth::user()->id ?? '' }})"
                            {{ isWishlisted($item->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="favorite_{{ $item->id }}"></label>
                    </div>
                @endif
            </div>
        </div>
        <div class="product_photo text-center">
            <a href="{{ route('frontend.ad.details', $item->slug) }}" class="stretched-link">
                <img src="{{ asset($item->thumbnail ?? 'front/no-image.png') }}" alt="image">
            </a>
        </div>
    </div>
    <div class="card-footer p-2 border-0">

        <div class="product-name mb-3">
            <h4>{{ Str::limit($item->title, 90, '..') }}</h4>
        </div>

        <div class="product_price mt-3 text-center">
            @if (isset($item->discount) && $item->discount > 0)
                <div class="product_old_price">
                    <span class="old">$ {{ $item->price ?? '0' }} </span>
                    <span>{{ $item->discount }}% OFF</span>
                </div>
            @endif
            <div class="product_current_price">
                <span>$
                    {{ number_format($item->discount && $item->discount > 0 ? discount_cal($item->price, $item->discount) : $item->price , 1, '.', ',')}}
                </span>
            </div>
        </div>
    </div>
</div>
