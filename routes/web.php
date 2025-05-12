<?php

use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware('auth')->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [ContactController::class, 'dashboard'])->name('dashboard');
    });

    Route::prefix('contacts')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('contacts');
        Route::get('/fetch-contacts', [ContactController::class, 'fetchContacts'])->name('fetchContacts');
        Route::post('/change-status/{id}', [ContactController::class, 'updateContactStatus'])->name('updateContactStatus');
        Route::post('/change-stage/{id}', [ContactController::class, 'updateStage'])->name('updateStage');
        Route::get('/preview-contact/{id}', [ContactController::class, 'previewContact'])->name('previewContact');
        Route::post('/delete-contact', [ContactController::class, 'deleteContact'])->name('deleteContact');
    });

    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'settings'])->name('settings');
        Route::post('/', [SettingsController::class, 'generateApiKey'])->name('generateApiKey');
        Route::post('/revoke-api-token', [SettingsController::class, 'revokeApiToken'])->name('revokeApiToken');
    });
});
