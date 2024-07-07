<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Manager\UserController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

/*authentication*/
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
    Route::get('user', [AuthenticatedSessionController::class, 'user'])->name('user');
    Route::middleware(['auth:sanctum'])
        ->post('logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
    Route::get('google', [GoogleController::class, 'google'])->name('google');
    Route::get('google/callback', [GoogleController::class, 'google_callback'])->name('google-callback');
});
/*panel user*/
Route::middleware(['auth:sanctum'])->prefix('user')->name('user-')->group(function () {
    Route::prefix('channel')->name('channel-')->group(function () {
        Route::get('show/{channel}', [ChannelController::class, 'show'])->name('show');
        Route::put('update/{channel}', [ChannelController::class, 'update'])->name('update');
    });
    Route::prefix('users')->name('users')->group(function () {
        Route::apiResource('/', UserController::class);
    });
});
/*panel manager*/
Route::middleware(['auth:sanctum'])->prefix('manager')->name('manager-')->group(function () {
    Route::apiResource('phones', PhoneController::class);
    Route::apiResource('county', CountryController::class);
    Route::apiResource('provinces', ProvinceController::class);
    Route::apiResource('locations', LocationController::class);
    Route::apiResource('city', CityController::class);
    /*channel*/
    Route::prefix('channel')->name('channel-')->group(function () {
        Route::get('show/{channel}', [ChannelController::class, 'show'])->name('show');
        Route::put('update/{channel}', [ChannelController::class, 'update'])->name('update');
    });
    /*users*/
    Route::prefix('users')->name('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user:id}', [UserController::class, 'show'])->name('show');
        Route::put('/{user:id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user:id}', [UserController::class, 'destroy'])->name('delete');
        Route::put('/active/{user:id}', [UserController::class, 'active'])->name('active');
        Route::put('/no-active/{user:id}', [UserController::class, 'no_active'])->name('no-active');
        Route::put('/ban/{user:id}', [UserController::class, 'ban'])->name('ban');
    });
    /*category*/
    Route::apiResource('category', CategoryController::class);
    Route::put('category-status-success/{category:id}', [CategoryController::class, 'success'])->name('category-status-success');
    Route::put('category-status-pending/{category:id}', [CategoryController::class, 'pending'])->name('category-status-pending');
    Route::put('category-status-reject/{category:id}', [CategoryController::class, 'reject'])->name('category-status-reject');

    /*tag*/
    Route::apiResource('tags', TagController::class);
    Route::put('tag-status-success/{tag:id}', [TagController::class, 'success'])->name('tag-status-success');
    Route::put('tag-status-pending/{tag:id}', [TagController::class, 'pending'])->name('tag-status-pending');
    Route::put('tag-status-reject/{tag:id}', [TagController::class, 'reject'])->name('tag-status-reject');

    /*tag user*/

});
