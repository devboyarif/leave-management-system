<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\GlobalController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\TestimonialController;

Route::middleware(['auth', 'check.admin.role'])->prefix('admin')->group(function () {
    // =========================================================================
    // ===================Users Routes========================================
    // ========================================================================

    // Admins
    Route::resource('/admins', UserController::class);

    // Companies
    Route::resource('/companies', CompanyController::class);
    Route::controller(CompanyController::class)->group(function () {
        Route::get('/companies/leaveTypes/{user}', 'companiesLeaveTypes')->name('companies.leaveTypes');
        Route::get('/companies/employees/{user}', 'companiesEmployees')->name('companies.employees');
    });

    // =========================================================================
    // ===================Leave and Subscription Routes========================
    // ========================================================================

    // Plans
    Route::resource('/plans', PlanController::class);
    Route::controller(PlanController::class)->group(function () {
        Route::put('/plans/set-recommended-plan/{plan}', 'setRecommended')->name('plans.set.recommended.plan');
        Route::put('/plans/set-default-plan/{plan}', 'setDefault')->name('plans.set.default.plan');
    });

    // Order
    Route::get('/orders', [OrderController::class, 'orders'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'orderDetails'])->name('orders.show');
    Route::get('/orders/pdf/download/{order}', [OrderController::class, 'orderPdfDownload'])->name('orders.pdf.download')->withoutMiddleware('check.admin.role');

    // Holidays
    Route::resource('/holidays', HolidayController::class);
    Route::controller(HolidayController::class)->group(function () {
        Route::get('/requested/holidays/{company}', 'requestedHolidays')->name('request.holidays.index');
        Route::post('/requested/holiday/accept', 'requestedHolidaysAccept')->name('request.holidays.accept');
        Route::delete('/requested/holiday/reject/{holiday}', 'requestedHolidaysReject')->name('request.holidays.reject');
    });

    // =========================================================================
    // ===================Others Routes========================================
    // ========================================================================
    Route::resource('/posts', BlogController::class);
    Route::resource('/faqs', FaqController::class);
    Route::resource('/testimonials', TestimonialController::class);
    Route::resource('/features', FeatureController::class);
    Route::get('/contact/messages', [GlobalController::class, 'contactMessages'])->name('contact.messages');
    Route::delete('/contact/message/{message}', [GlobalController::class, 'contactMessageDelete'])->name('contact.messages.destroy');

    // =========================================================================
    // ===================Setting Routes========================================
    // ========================================================================

    // Languages Routes
    Route::controller(LanguageController::class)->prefix('setting')->name('languages.')->group(function () {
        Route::get('languages', 'index')->name('index');
        Route::post('languages', 'store')->name('store');
        Route::put('languages/{lang}', 'update')->name('update');
        Route::put('{lang}', 'defaultLanguage')->name('set.default');
        Route::delete('languages/{lang}', 'destroy')->name('destroy');
        Route::get('languages/translation/{lang}', 'translationEdit')->name('translation.edit');
        Route::put('languages/translation/{lang}', 'translationUpdate')->name('translation.update');
        Route::put('languages/status/{lang}', 'statusUpdate')->name('status.update');
        Route::get('languages/translate/single', 'singleTranslate')->name('translate');
        Route::get('languages/translate/all', 'allTranslate')->name('translate.all');
    });

    // Themes Routes
    Route::controller(ThemeController::class)->group(function () {
        Route::get('/setting/theme', 'theme')->name('theme');
        Route::post('/setting/theme', 'adminThemeUpdate')->name('theme.admin.update');
        Route::post('/setting/website/theme', 'websiteThemeUpdate')->name('theme.website.update');
    });

    // Configurations & Settings
    Route::controller(SettingController::class)->prefix('settings')->group(function () {
        Route::get('/general', 'general')->name('settings.general');
        Route::post('/general/setting/update', 'generalSettingUpdate')->name('settings.general.update');

        // cms routes
        Route::get('/cms', 'cms')->name('settings.cms');
        Route::put('/cms/update', 'cmsUpdate')->name('settings.cms.update');

        // Payment Routes
        Route::get('/payment', 'payment')->name('settings.payment');
        Route::get('/payment/data', 'paymentData')->name('settings.payment.data');
        Route::put('/payment/update', 'paymentDataUpdate')->name('settings.payment.update');

        // Seo route
        Route::get('/seo', 'seo')->name('settings.seo');
        Route::put('/seo/update/{seo}', 'seoUpdate')->name('settings.seo.update');

        // SMTP Routes
        Route::get('/smtp', 'smtp')->name('settings.smtp');
        Route::put('/smtp/update', 'smtpUpdate')->name('settings.smtp.update');
        Route::post('/send/test-email', 'testEmailSend')->name('settings.send.test.email');

        // Upgrade application
        Route::get('/upgrade', 'upgrade')->name('settings.upgrade');
        Route::post('/upgrade/system', 'upgradeSystem')->name('settings.upgrade.system');

        // Currency Routes
        Route::prefix('currency')->prefix('currency')->name('settings.')->group(function () {
            Route::get('/', 'currency')->name('currency');
            Route::post('/', 'storeCurrency')->name('currency.store');
            Route::delete('{currency}', 'deleteCurrency')->name('currency.destroy');
            Route::put('{currency}', 'updateCurrency')->name('currency.update');
            Route::put('{currency}', 'statusUpdateCurrency')->name('currency.status.update');
            Route::put('{currency}', 'defaultCurrency')->name('currency.set.default');
        });
    });
});

// Profile & Settings
Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/profile', 'profile')->name('user.profile');
    Route::post('/profile/update', 'profileUpdate')->name('user.profile.update');
    Route::post('/password/update', 'passwordUpdate')->name('user.password.update');
    Route::delete('/account/delete', 'accountDelete')->name('user.account.delete');
});

Route::controller(GlobalController::class)->group(function () {
    Route::get('/diff/between/days', 'diffBetweenDays')->name('difference.between.days');
    Route::get('/user/notifications', 'notifications')->name('notifications.index');
    Route::get('/get/translated/message', 'getTranslatedMessage')->name('get.translated.text');
    Route::get('/error/403', 'error403')->name('error.403');
    Route::get('/all/countries', 'allCountries')->name('all.countries');
    Route::get('/all/team/sizes', 'allTeamSizes')->name('all.team.sizes');
    Route::get('/app/setting', 'appSetting')->name('app.setting');
    Route::get('/userid/wise/company', 'useridWiseCompany')->name('userid.wise.company');
    Route::get('/language/{language}', 'switchLanguage')->name('language');
    Route::get('/mark/read/notification', 'markAsReadNotification')->name('markasread.notifications');
});
