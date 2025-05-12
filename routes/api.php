<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyTokenEmail;

Route::middleware(['auth:sanctum', VerifyTokenEmail::class])->group(function () { 
    Route::prefix('contacts')->group(function () {
        Route::post('/store-new-contact', [ContactController::class, 'store'])->name('storeNewContact');
    });
});