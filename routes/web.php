<?php

use App\Http\Controllers\PageAController;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/auth');


Route::group([
    'prefix' => 'auth',
    'middleware' => VerifyCsrfToken::class
], function () {
    Route::get('', [AuthController::class, 'registrationForm']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('regenerate-link', [AuthController::class, 'regenerate']);
    Route::post('deactivate-link', [AuthController::class, 'deactivate']);
});

Route::group(['prefix' => 'game'], function () {
    Route::get('{uuid}', [PageAController::class, 'game']);
    Route::post('play', [PageAController::class, 'play']);
    Route::post('history', [PageAController::class, 'history']);
});
