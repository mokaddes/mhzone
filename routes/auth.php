<?php

use App\Http\Controllers\Frontend\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

// Frontend Authentication
Auth::routes(['login' => false, 'register' => false]);
// registration proccess
Route::controller(FrontendController::class)->group(function () {
    Route::get('sign-up', 'signUp')->name('frontend.signup');
    Route::post('user/register', 'register')->name('user.register');
    Route::post('/frontend/logout', 'frontendLogout')->name('user.logout');
});
// login proccess
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('user.login')->middleware('auth_logout');
Route::post('/user/login', [LoginController::class, 'login'])->name('user.login.store')->middleware('auth_logout');
// Customer Reset Password
Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('forgot/password', 'customerResetPasswordForm')->name('customer.forgot.password');
    Route::post('customer/password/mail', 'sendResetLinkEmail')->name('customer.password.email');
});
// ResetPassword
Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('password-reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('customer-password-update', 'reset')->name('customer.password.update');
});
// Social Authentication
Route::controller(SocialLoginController::class)->group(function () {
    Route::get('/auth/{provider}/redirect', 'redirect')->where('provider', 'google|facebook|twitter|linkedin|github|gitlab|bitbucket');
    Route::get('/auth/{provider}/callback', 'callback')->where('provider', 'google|facebook|twitter|linkedin|github|gitlab|bitbucket');
});
//Auth Guard Logout
Route::post('auth-logout', function (Request $request) {
        Auth::guard('user')->logout();
})->name('auth.logout');
// Admin Authentication
Route::controller(AdminLoginController::class)->prefix('admin')->group(function () {
    Route::get('/login', 'showLoginForm')->name('login.admin');
    Route::post('/login', 'login')->name('admin.login');
    Route::post('/logout', 'logout')->name('admin.logout');
});
// guest admin
Route::middleware(['guest:admin'])->group(function () {
    // reset password
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::post('password/email', 'sendResetLinkEmail')->name('admin.password.email');
        Route::get('password/reset', 'showLinkRequestForm')->name('admin.password.request');
    });
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::post('password/reset', 'reset')->name('admin.password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('admin.password.reset');
    });
});
