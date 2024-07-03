<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Manager\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
    Route::get('user', [AuthenticatedSessionController::class, 'user'])->name('user');
    Route::middleware(['auth:sanctum'])
        ->post('logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
    Route::get('google' , [GoogleController::class , 'google'])->name('google');
    Route::get('google/callback' , [GoogleController::class , 'google_callback'])->name('google-callback');
});


Route::middleware(['auth:sanctum'])->prefix('user')->name('user-')->group(function ( ) {
    Route::prefix('channel')->name('channel-')->group(function () {
       Route::get('show/{channel}' , [ChannelController::class , 'show'])->name('show');
       Route::put('update/{channel}' , [ChannelController::class , 'update'])->name('update');
    });

    Route::prefix('users')->name('users')->group(function () {
        Route::apiResource('/' , UserController::class);
    });
});

Route::middleware(['auth:sanctum'])->prefix('manager')->name('manager-')->group(function ( ) {
    Route::prefix('channel')->name('channel-')->group(function () {
        Route::get('show/{channel}' , [ChannelController::class , 'show'])->name('show');
        Route::put('update/{channel}' , [ChannelController::class , 'update'])->name('update');
    });

    Route::prefix('users')->name('users')->group(function () {
        Route::apiResource('/' , UserController::class);
    });
});
