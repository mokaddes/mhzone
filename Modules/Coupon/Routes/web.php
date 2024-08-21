<?php

use Illuminate\Support\Facades\Route;
use Modules\Coupon\Http\Controllers\CouponController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth:admin', 'set_lang'])->group(function () {
Route::prefix('admin/coupon')->group(function() {
    Route::get('/', [CouponController::class, 'index'])->name('module.coupon.index');
    Route::get('/create', [CouponController::class, 'create'])->name('module.coupon.create');
    Route::post('/store', [CouponController::class, 'store'])->name('module.coupon.store');
    Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('module.coupon.edit');
    Route::put('/update/{id}', [CouponController::class, 'update'])->name('module.coupon.update');
    Route::delete('/delete/{id}', [CouponController::class, 'destroy'])->name('module.coupon.destroy');
});
});
