<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('test');
});
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
    Route::middleware(['auth:sanctum'])
        ->post('logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');
    Route::get('/google' , [GoogleController::class , 'google'])->name('google');
    Route::get('google/callback' , [GoogleController::class , 'google_callback'])->name('google-callback');
});

require __DIR__.'/auth.php';
