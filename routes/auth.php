<?php

use App\Http\Controllers\Auth\GithubLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// GIthub Authentication
// Route::get('/auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])
//     ->where('provider', 'github|google|twitter|gitlab|bitbucket|facebook|linkedin|slack');

// Route::get('/auth/{provider}/callback', [SocialLoginController::class, 'callback'])
//     ->where('provider', 'github|google|twitter|gitlab|bitbucket|facebook|linkedin|slack');
