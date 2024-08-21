<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\Http\Controllers\CategoryController;
use Modules\Category\Http\Controllers\MeasurementController;
use Modules\Category\Http\Controllers\SubCategoryController;

Route::prefix('admin')->middleware(['auth:admin', 'set_lang'])->group(function () {
    // Category Routes
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('module.category.index');
        Route::get('/add', [CategoryController::class, 'create'])->name('module.category.create');
        Route::post('/add', [CategoryController::class, 'store'])->name('module.category.store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('module.category.edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('module.category.update');
        Route::get('/{category:slug}/ads', [CategoryController::class, 'show'])->name('module.category.show');
        Route::delete('/destroy/{category}', [CategoryController::class, 'destroy'])->name('module.category.destroy');
        Route::post('/category/update/order', [CategoryController::class, 'updateOrder'])->name('module.category.updateOrder');
        Route::get('/status/change', [CategoryController::class, 'status_change'])->name('module.category.status.change');
        // Route::get('/custom/field/{category}', [CategoryController::class, 'customField'])->name('module.category.custom.field');
    });

    // subCategory Routes
    Route::prefix('subcategory')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('module.subcategory.index');
        Route::get('/add', [SubCategoryController::class, 'create'])->name('module.subcategory.create');
        Route::post('/add', [SubCategoryController::class, 'store'])->name('module.subcategory.store');
        Route::get('/edit/{subcategory}', [SubCategoryController::class, 'edit'])->name('module.subcategory.edit');
        Route::get('/{subcategory:slug}/ads', [SubCategoryController::class, 'show'])->name('module.subcategory.show');
        Route::put('/update/{subcategory}', [SubCategoryController::class, 'update'])->name('module.subcategory.update');
        Route::delete('/destroy/{subcategory}', [SubCategoryController::class, 'destroy'])->name('module.subcategory.destroy');
        Route::get('/status/change', [SubCategoryController::class, 'status_change'])->name('module.subcategory.status.change');
    });
    Route::prefix('measurement')->group(function () {
        Route::get('/', [MeasurementController::class, 'index'])->name('module.measurement.index');
        Route::get('/add', [MeasurementController::class, 'create'])->name('module.measurement.create');
        Route::post('/store', [MeasurementController::class, 'store'])->name('module.measurement.store');
        Route::get('/edit/{measurement}', [MeasurementController::class, 'edit'])->name('module.measurement.edit');
        Route::post('/update/{measurement}', [MeasurementController::class, 'update'])->name('module.measurement.update');
        Route::delete('/destroy/{measurement}', [MeasurementController::class, 'destroy'])->name('module.measurement.destroy');
    });
});
Route::get('/get-sub-categories/{category_id}', [CategoryController::class, 'getSubcategories']);
