<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TourismController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function(){ return view('auth.login'); });
Route::get('/', [WelcomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);
Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/tourism', [TourismController::class, 'index']);
Route::get('/room_detail{id}', [RoomController::class, 'room_detail']);
Route::get('/about', function (){ return view('about'); });
Route::get('/contact', function (){ return view('contact'); });

Route::prefix('auth')->group(function(){
    Route::get('/', [LoginController::class, 'handleRedirectAuth'])->name('redirect');
    Route::get('/google/callback', [LoginController::class, 'googleCallback']);
    Route::get('/facebook/callback', [LoginController::class, 'facebookCallback']);
    Route::get('/telegram/callback', [LoginController::class, 'telegramCallback']);
});

