<?php
use Illuminate\Support\Facades\Route;
use Modules\ChildCategory\Http\Controllers\ChildCategoryController;

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
Route::prefix('admin')->middleware(['auth:admin', 'set_lang'])->group(function () {

Route::prefix('childcategory')->group(function() {
    Route::get('/', [ChildCategoryController::class,'index'])->name('module.childcategory.index');
    Route::get('/create', [ChildCategoryController::class,'create'])->name('module.childcategory.create');
    Route::post('/store', [ChildCategoryController::class,'store'])->name('module.childcategory.store');
    Route::get('/show/{childcategory}', [ChildCategoryController::class,'store'])->name('module.childcategory.show');
    Route::get('/edit/{childcategory}', [ChildCategoryController::class,'edit'])->name('module.childcategory.edit');
    Route::put('/edit/{childcategory}', [ChildCategoryController::class,'update'])->name('module.childcategory.update');


    Route::delete('/destroy/{childcategory}', [ChildCategoryController::class, 'destroy'])->name('module.childcategory.destroy');

    });
});
