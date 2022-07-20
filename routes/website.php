<?php

use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::controller(WebsiteController::class)->group(function () {
    Route::get('/', 'home')->name('website.home');
    Route::get('/about', 'about')->name('website.about');
    Route::get('/pricing', 'pricing')->name('website.pricing');
    Route::get('/contact', 'contact')->name('website.contact');
    Route::get('/blog', 'blog')->name('website.blog');
    Route::get('/blog/{post:slug}', 'blogDetails')->name('website.blog.details');
});
