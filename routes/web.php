<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ReservationController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\TourismController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::prefix('rooms')->group(function(){
    Route::get('/', [RoomController::class, 'index'])
        ->name('room');
    Route::get('/{branch_id}/{branch_name}', [RoomController::class, 'show'])
        ->name('room.show');
});

Route::prefix('tourism')->group(function(){
    Route::get('/', [TourismController::class, 'index'])
        ->name('tourism');
});


Route::prefix('auth')->group(function(){
    Route::get('/', [LoginController::class, 'handleRedirectAuth'])
        ->name('redirect');
    Route::get('/google/callback', [LoginController::class, 'googleCallback']);
    Route::get('/facebook/callback', [LoginController::class, 'facebookCallback']);
    Route::get('/telegram/callback', [LoginController::class, 'telegramCallback']);
    Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
});

Route::prefix('user')->middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'index'])
        ->name('profile');
    Route::get('/logout', [DashboardController::class, 'logout'])
        ->name('logout');
    Route::post('/reservation', [ReservationController::class, 'store'])
        ->name('reservation');
});
