<?php

use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::controller(WebsiteController::class)->group(function () {
    Route::get('/', 'home')->name('website.home');
    Route::get('/about', 'about')->name('website.about');
    Route::get('/pricing', 'pricing')->name('website.pricing');
    Route::get('/plan/{plan:slug}', 'planDetails')->name('website.plan.details');
    Route::get('/contact', 'contact')->name('website.contact');
    Route::get('/blog', 'blog')->name('website.blog');
    Route::get('/blog/{post:slug}', 'blogDetails')->name('website.blog.details');
    Route::get('/privacy-policy', 'privacyPolicy')->name('website.privacy.policy');
    Route::get('/terms-conditions', 'termsCondition')->name('website.terms.condition');
});
