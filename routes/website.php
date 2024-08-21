<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Frontend\AdPostController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserAddressController;
use App\Http\Controllers\Frontend\UserCardController;
use App\Http\Controllers\Frontend\UserShopController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

// show website pages
Route::group(['as' => 'frontend.'], function () {
    Route::controller(FrontendController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/shop/{department?}', 'shop')->name('shop');
        Route::get('/seller/shop/{slug}/{department?}', 'sellerShop')->name('seller.shop');
        Route::get('ad/details/{ad:slug}', 'adDetails')->name('ad.details');
        Route::get('addToFavorite', 'addToFavorite')->name('addToFavorite');
        Route::get('help-center', 'helpCenter')->name('helpcenter');
        Route::post('contact/store', 'storeContact')->name('contact.store');
        Route::get('privacy-policy', 'privacyPolicy')->name('privacyPolicy');
        Route::get('terms-conditions', 'termsCondition')->name('termsCondition');
        Route::get('about-us', 'aboutUs')->name('about-us');

    });
    // card
    Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/add', 'add')->name('add');
        Route::get('/update', 'update')->name('update');
    });
    // user
    Route::middleware(['auth:user', 'verified'])->group(function () {
        // User Dashboard
        Route::prefix('dashboard')->name('user.')->group(function () {
            Route::get('/', [DashboardController::class, 'profile'])->name('profile');
            Route::get('/switch-mode/{mode}', [DashboardController::class, 'switchMode'])->name('switch.mode');
            Route::get('my-order', [DashboardController::class, 'myOrder'])->name('myOrder');
            Route::get('wishlist', [DashboardController::class, 'wishlist'])->name('wishlist');
            Route::get('wishlist-remove/{id}', [DashboardController::class, 'wishlistRemove'])->name('remove.wishlist');
            Route::get('profile/edit', [DashboardController::class, 'profileEdit'])->name('profileEdit');
            Route::post('profile/update', [DashboardController::class, 'profileUpdate'])->name('profile.update');
            Route::post('account-delete/{id}', [DashboardController::class, 'deleteAccount'])->name('account.delete');
            Route::get('transaction', [DashboardController::class, 'transaction'])->name('transaction');
            Route::get('my-ads', [DashboardController::class, 'myAds'])->name('myAds');
            // Card save
            Route::get('saved/card', [UserCardController::class, 'index'])->name('card');
            Route::post('saved/card/store', [UserCardController::class, 'store'])->name('card.store');
            // Address save
            Route::get('saved/address', [UserAddressController::class, 'index'])->name('address');
            Route::post('saved/address', [UserAddressController::class, 'store'])->name('address.store');
            Route::get('saved/address/create', [UserAddressController::class, 'create'])->name('address.create');
            Route::get('saved/address/edit/{address_id}', [UserAddressController::class, 'edit'])->name('address.edit');
            Route::get('saved/address/delete/{address_id}', [UserAddressController::class, 'destroy'])->name('address.delete');
            Route::post('update/address/{id}', [UserAddressController::class, 'update'])->name('address.update');
            // User shop
            Route::get('my-shop/{department?}', [UserShopController::class, 'index'])->name('myShop');
            Route::get('create/shop', [UserShopController::class, 'create'])->name('shop.create');
            Route::post('store/shop', [UserShopController::class, 'store'])->name('shop.store');
            Route::post('update/shop/{id}', [UserShopController::class, 'update'])->name('shopUpdate');
        });
        // Ad post
        Route::controller(AdPostController::class)->prefix('post')->name('post.')->group(function () {
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/category', 'getCategory')->name('getCategory');
            Route::get('/subcategory', 'getSubcategory')->name('getSubcategory');
            Route::get('/edit/{slug}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::get('ad/delete/{id}', 'deletePost')->name('delete');
        });

        // Checkout and order place
        Route::controller(CheckoutController::class)->group(function () {
            Route::get('/checkout', 'index')->name('checkout');
            Route::get('paypal/success', 'successTransaction')->name('paypal.success');
            Route::get('paypal/cancel', 'cancelTransaction')->name('paypal.cancel');
            Route::post('/order/place', 'orderPlace')->name('order.place');
            Route::get('/order/success/{id}', 'orderComplete')->name('order.success');
            Route::get("apply/coupon", "couponApply")->name('couponApply');
            Route::get('getSavedAddress', 'getSavedAddress')->name('getSavedAddress');
        });
        // Order Manage
        Route::controller(OrderController::class)->prefix('order')->name('order.')->group(function () {
            Route::get('/details/{order_number}', 'orderDetails')->name('details');
            Route::post('/change-status/{id}', 'changeStatus')->name('changeStatus');
            Route::get('invoice/{id}', 'invoice')->name('invoice');
        });
        // Review
        Route::controller(ReviewController::class)->prefix('review')->name('review.')->group(function () {
            Route::post('/store', 'store')->name('store');
        });
    });
});
// Verification Routes
Route::controller(VerificationController::class)->middleware('auth:user')->group(function () {
    Route::get('/email/verify', 'show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', 'resend')->name('verification.resend');
});
// Social Authentication
Route::controller(SocialLoginController::class)->group(function () {
    Route::get('/auth/{provider}/redirect', 'redirect')->where('provider', 'google|facebook|twitter|linkedin|github|gitlab|bitbucket')->name('social-login');
    Route::get('/auth/{provider}/callback', 'callback')->where('provider', 'google|facebook|twitter|linkedin|github|gitlab|bitbucket');
});
// transection
Route::get('transaction-clean', function () {
    DB::table('transactions')->truncate();
    return "success";
});
// order clean
Route::get('order-clean', function () {
    DB::table('item_purchases')->truncate();
    return "success";
});
// cache celar
Route::get('cache-clear', function () {
    Artisan::call('optimize:clear');
    return "success";
});
// get child
Route::post('get_child_category/', [AdPostController::class, 'getChildcategory'])->name('getChildcategory');
