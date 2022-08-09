<?php

use App\Http\Controllers\BaseboardController;
use App\Http\Controllers\GoogleDriveConnectionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Baseboard Routes
|--------------------------------------------------------------------------
*/
Route::name('baseboard.')->prefix('baseboard')->group(function () {
    Route::get('/', [BaseboardController::class, 'index'])->name('index');
    Route::get('/generate-auth', [GoogleDriveConnectionController::class, 'generateAuthRequest'])->name('admin.generate-auth');
    // Route to generate bearer token
    Route::post('/authorise', [GoogleDriveConnectionController::class, 'authorise'])->name('admin.authorise');
});
