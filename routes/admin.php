<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\CmsSettingController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialiteController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WithdrawController;
use App\Http\Controllers\ContactHelpController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
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
    // auth amdin
    Route::middleware(['auth:admin'])->group(function () {
        //Dashboard Route
        Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'dashboard');
            Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
            Route::post('/admin/search', 'search')->name('admin.search');
        });
        //Profile Route
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/profile/settings', 'setting')->name('profile.setting');
            Route::get('/profile', 'profile')->name('profile');
            Route::put('/profile', 'profile_update')->name('profile.update');
        });
        // Order Section
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/details/{order_number}', [OrderController::class, 'orderDetails'])->name('admin.orders.details');
        Route::post('/change-status/{id}', [OrderController::class, 'changeStatus'])->name('admin.order.changeStatus');

        // Route::get('/details/{order_number}', 'orderDetails')->name('orderDetails');
        //Roles Route
        Route::resource('role', RolesController::class);
        //Users Route
        Route::resource('user', UserController::class);
        // Report
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');
        Route::get('/report/view/{id}', [ReportController::class, 'view'])->name('report.view');
        // Size
        Route::resource('/size', SizeController::class);
        Route::post('/size/status/change', [SizeController::class, 'statusChange'])->name('size.status.change');
        //Department
        Route::group(['prefix' => 'departments', 'as' => 'department.'], function () {
            Route::get('/', [DepartmentController::class, 'index'])->name('index');
            Route::get('/create', [DepartmentController::class, 'create'])->name('create');
            Route::post('/store', [DepartmentController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [DepartmentController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
            Route::get('/department/status/change', [DepartmentController::class, 'status'])->name('status');
        });

        Route::get('transactions', [TransactionController::class, 'index'])->name('transactions');
        Route::get('invoice/{id}', [TransactionController::class, 'invoice'])->name('admin.invoice');
        Route::get('seller-payment/{id}/{status}', [TransactionController::class, 'sellerPayment'])->name('admin.seller.payment');

        //Coupons
        Route::group(['prefix' => 'coupons', 'as' => 'coupons.'], function () {
            Route::get('/', [CouponController::class, 'index'])->name('index');
            Route::get('/create', [CouponController::class, 'create'])->name('create');
            Route::post('/store', [CouponController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CouponController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [CouponController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [CouponController::class, 'delete'])->name('delete');
            Route::get('/view/{id}', [CouponController::class, 'view'])->name('view');

        });
        // Color
        Route::resource('/color', ColorController::class);
        Route::post('/color/status', [ColorController::class, 'statusChange'])->name('color.status.change');
        // Setting
        Route::controller(SettingsController::class)->prefix('settings')->name('settings.')->group(function () {
            Route::get('general', 'general')->name('general');
            Route::put('general', 'generalUpdate')->name('general.update');
            Route::get('layout', 'layout')->name('layout');
            Route::put('layout', 'layoutUpdate')->name('layout.update');
            Route::put('mode', 'modeUpdate')->name('mode.update');
            Route::get('theme', 'theme')->name('theme');
            Route::put('theme', 'colorUpdate')->name('theme.update');
            Route::get('custom', 'custom')->name('custom');
            Route::put('custom', 'custumCSSJSUpdate')->name('custom.update');
            Route::get('email', 'email')->name('email');
            Route::put('email', 'emailUpdate')->name('email.update');
            Route::post('test-email', 'testEmailSent')->name('email.test');
            // sytem update
            Route::get('system', 'system')->name('system');
            Route::put('system/update', 'systemUpdate')->name('system.update');
            Route::put('search/indexing', 'searchIndexing')->name('search.indexing');
            Route::put('google-analytics', 'googleAnalytics')->name('google.analytics');
            Route::put('facebook-pixel', 'facebookPixel')->name('facebook.pixel');
            Route::put('allowLangChanging', 'allowLaguageChanage')->name('allow.langChange');
            Route::put('change/timezone', 'timezone')->name('change.timezone');
            // cookies routes
            Route::get('cookies', 'cookies')->name('cookies');
            Route::put('cookies/update', 'cookiesUpdate')->name('cookies.update');
            // seo
            Route::get('seo/index', 'seoIndex')->name('seo.index');
            Route::get('seo/edit/{page}', 'seoEdit')->name('seo.edit');
            Route::put('seo/update/{page}', 'seoUpdate')->name('seo.update');
            // databse backup
            Route::get('database/backup/index', 'backupIndex')->name('database.backup.index');
            Route::post('database/backup/store', 'backupStore')->name('database.backup.store');
            Route::delete('database/backup/destroy/{file}', 'backupDestroy')->name('database.backup.destroy');
            Route::get('database/backup/download/{file}', 'backupDownload')->name('database.backup.download');
            // recaptcha Update
            Route::put('recaptcha/update', 'recaptchaUpdate')->name('recaptcha.update');
            Route::post('recaptcha/update/status', 'recaptchaUpdateStatus')->name('recaptcha.status.update');
            // module routes
            Route::get('modules', 'module')->name('module');
            Route::put('module/update', 'moduleUpdate')->name('module.update');
            // website configuration
            Route::put('website/configuration/update', 'websiteConfigurationUpdate')->name('website.configuration.update');
            // pusher configuration
            Route::put('pusher/configuration/update', 'pusherConfigurationUpdate')->name('pusher.configuration.update');
            // website watermark update
            Route::put('website/watermark/update', 'websiteWatermarkUpdate')->name('website.watermark.update');
        });
        // Socialite
        Route::controller(SocialiteController::class)->group(function () {
            Route::get('settings/social-login', 'index')->name('settings.social.login');
            Route::put('settings/social-login', 'update')->name('settings.social.login.update');
            Route::post('settings/social-login/status', 'updateStatus')->name('settings.social.login.status.update');
        });
        // Payment
        Route::controller(PaymentController::class)->group(function () {
            Route::get('settings/payment', 'index')->name('settings.payment');
            Route::put('settings/payment', 'update')->name('settings.payment.update');
            Route::post('settings/payment/status', 'updateStatus')->name('settings.payment.status.update');
        });
        //   Skin System
        Route::controller(ThemeController::class)->group(function () {
            Route::get('/skins', 'index')->name('module.themes.index');
            Route::put('/skins', 'update')->name('module.themes');
        });
        //  Website Page Setting
        Route::controller(SettingsController::class)->group(function () {
            Route::put('/posting-rules', 'postingRulesUpdate')->name('admin.posting.rules.upadte');
            // Route::put('/about', 'updateAbout')->name('admin.about.upadte');
            Route::put('/terms', 'updateTerms')->name('admin.terms.upadte');
            Route::put('/privacy', 'updatePrivacy')->name('admin.privacy.upadte');
        });
        // Website SEO Setting
        Route::put('/seo', [SettingsController::class, 'updateSeo'])->name('admin.seo.update');
        // Website CMS Setting
        Route::controller(CmsSettingController::class)->prefix('settings')->group(function () {
            Route::get('/cms', 'index')->name('settings.cms');
            Route::put('/home', 'updateHome')->name('admin.home.update');
            Route::put('/about', 'updateAbout')->name('admin.about.update');
            Route::put('/terms', 'updateTerms')->name('admin.terms.update');
            Route::put('/privacy', 'updatePrivacy')->name('admin.privacy.update');
            Route::put('/datadeletion', 'updatedatadeletion')->name('admin.datadeletion.update');
            Route::put('/posting-rules', 'postingRulesUpdate')->name('admin.posting.rules.update');
            Route::put('/get-membership', 'updateGetMembership')->name('admin.getmembership.update');
            Route::put('/pricing-plan', 'updatePricingPlan')->name('admin.pricingplan.update');
            Route::put('/blog', 'updateBlog')->name('admin.blog.update');
            Route::put('/ads', 'updateAds')->name('admin.ads.update');
            Route::put('/contact', 'updateContact')->name('admin.contact.update');
            Route::put('/faq', 'updateFaq')->name('admin.faq.update');
            Route::put('/dashboard', 'updateDashboard')->name('admin.dashboard.update');
            Route::put('/auth-content', 'updateAuthContent')->name('admin.authcontent.update');
            Route::put('/coming-soon', 'updateComingSoon')->name('admin.comingsoon.update');
            Route::put('/maintenance', 'updateMaintenance')->name('admin.maintenance.update');
            Route::put('/errorpages', 'updateErrorPages')->name('admin.errorpages.update');
            Route::resource('slider', SliderController::class);
            Route::get('slider/update/status', [SliderController::class, 'updateStatus'])->name('slider.update.status');
        });
        // ContactHelp
        Route::resource('/contact-help', ContactHelpController::class);
        Route::get('/withdraw-request', [WithdrawController::class, 'index'])->name('admin.withdrawRequest.index');
        Route::get('/withdraw-request/{withdrawRequest}', [WithdrawController::class, 'edit'])->name('admin.withdrawRequest.edit');
        Route::put('/withdraw-request/{withdrawRequest}', [WithdrawController::class, 'update'])->name('admin.withdrawRequest.update');
    });
});
