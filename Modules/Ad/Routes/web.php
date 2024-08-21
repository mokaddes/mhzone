<?php

use Illuminate\Support\Facades\Route;
use Modules\Ad\Http\Controllers\AdController;
use Modules\Ad\Http\Controllers\GalleryController;




// subcategory & town dropdown routes
Route::get('get_subcategory/{id}', [AdController::class, 'getSubcategory']);
// Route::post('get_child_category/', [AdController::class, 'getChildcategory'])->name('getChildcategory');
Route::middleware(['auth:admin', 'set_lang'])->group(function () {



    Route::group(['as' => 'module.ad.', 'prefix' => 'admin/ad', 'namespace' => 'Auth'], function () {

        // ad gallery routes
        Route::get('/gallery/{id}', [GalleryController::class, 'showGallery'])->name('show_gallery');
        Route::post('/ad-gallery/{id}', [GalleryController::class, 'storeGallery'])->name('store_gallery');
        Route::delete('/gallery/{image}', [GalleryController::class, 'deleteGallery'])->name('delete_gallery');

        // ad crud routes
        Route::get('/', [AdController::class, 'index'])->name('index');
        Route::get('/add', [AdController::class, 'create'])->name('create');
        Route::post('/add', [AdController::class, 'store'])->name('store');
        Route::get('/edit/{ad}', [AdController::class, 'edit'])->name('edit');
        Route::put('/update/{ad}', [AdController::class, 'update'])->name('update');
        Route::get('/favourite/change', [AdController::class, 'favourite_change'])->name('change');
        Route::get('/show/{ad:slug}', [AdController::class, 'show'])->name('show');
        Route::delete('/destroy/{ad}', [AdController::class, 'destroy'])->name('destroy');
        Route::get('/status/{ad:slug}/{status}', [AdController::class, 'status'])->name('status');
        Route::post('/deal_of_the_day/{slug}',[AdController::class, 'dealOfTheDay'])->name('deal_of_the_day');
        Route::get('/is_banner/active/{id}',[AdController::class,'activeBanner'])->name('is_bannr.active');
        Route::get('/is_banner/inactive/{id}',[AdController::class,'inactiveBanner'])->name('is_bannr.inactive');

        // Custom fields routes
        Route::get('/category/field/{ad}', [AdController::class, 'addCustomFieldValue'])->name('custom.field.value');
        Route::get('/category/field/{ad}/edit', [AdController::class, 'editCustomFieldValue'])->name('custom.field.value.edit');
        Route::get('/category/field/{ad}/sorting', [AdController::class, 'sortingCustomFieldValue'])->name('custom.field.value.sorting');
        Route::post('/category/field/sorting/store', [AdController::class, 'sortingCustomFieldValueStore'])->name('custom.field.value.sorting.store');

        Route::post('/category/field/{ad}', [AdController::class, 'storeCustomFieldValue'])->name('custom.field.value.store');
        Route::put('/category/field/{ad}', [AdController::class, 'updateCustomFieldValue'])->name('custom.field.value.update');
    });
});
