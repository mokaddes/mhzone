<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdController;
use App\Http\Controllers\Api\AppController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\MessengerController;


// auth api
Route::middleware(['auth:api'])->group(function () {
    // Customer Controller
    Route::controller(CustomerController::class)->group(function () {
        Route::post('/auth/password', 'passwordUpdate');
        Route::post('/auth/profile', 'profileUpdate');
        Route::get('/customer/ads', 'allAds');
        Route::get('/customer/recent-ads', 'recentAds');
        Route::put('/customer/ads/{ad}/active', 'activeAd');
        Route::put('/customer/ads/{ad}/expire', 'expireAd');
        Route::delete('/customer/ads/{ad}/delete', 'deleteAd');
        Route::delete('/customer/account-delete', 'deleteCustomer');
        Route::get('/user/ads', 'allAds');
        Route::post('/ads/{ad}/favourite', 'favouriteAddRemove');
        Route::get('/customer/dashboard-overview', 'dashboardOverview');
        Route::get('/customer/dashboard-adsviews', 'adsViewsSummery');
        Route::get('/customer/favourite-list', 'favouriteAds');
        Route::get('/customer/recent-invoices', 'recentInvoice');
        Route::get('/customer/activity-logs', 'activityLogs');
        Route::get('/customer/plan', 'planLimit');
        Route::post('/customer/plan-upgrade/testing', 'planUpgradeTesting');
    });
    // Messenger Controller
    Route::controller(MessengerController::class)->group(function () {
        Route::get('message/{username?}', 'index');
        Route::post('message/{username}', 'sendMessage');
    });
});
// Category Controller
Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'categories');
    Route::get('/categories/{category}/subcategories', 'categoriesSubcategories');
});
// Ad Controller
Route::controller(AdController::class)->group(function () {
    Route::get('/ads/{category}/category', 'categoryWiseAds');
    Route::get('/ads/{ad:slug}', 'adDetails');
    Route::get('/ads', 'adsCollection');
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/ads', 'storeAd');
        Route::get('/ads/{ad}/edit', 'editAd');
        Route::post('/ads/{ad}/update', 'updateAd');
        Route::delete('/ads/gallery/{ad_gallery}', 'deleteAdGallery');
    });
});
// App Controller
Route::controller(AppController::class)->group(function () {
    Route::get('/testimonials', 'testimonialList');

    Route::get('/contacts-help', 'contactHelp');
    Route::get('/contacts-help-reson', 'requestReason');
    Route::post('/contacts', 'contactMessage');
    Route::get('/faqscategories', 'faqsCategory');
    Route::get('/faqscategories/{category}/faq', 'categoriesFaq');
    Route::get('/cities', 'cities');
    Route::get('/contact-content', 'contactContent');
    Route::get('/postingrules-content', 'postingrulesContent');
    Route::get('/about-content', 'aboutContent');
    Route::get('/brands', 'brands');
    Route::get('/pricing-plans', 'planList');
    Route::post('/fcm-token', 'generateToken');
});
// App setting
Route::get('/settings', [SettingController::class, 'appSetting']);
Route::get('/', [HomeController::class, 'index']);
