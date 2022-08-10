<?php

use App\Http\Controllers\BaseboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\GoogleDriveConnectionController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| These are the routes for a user's dashboard.
|
*/

// Baseboard web routes
require 'web/baseboard.php';

// Route to show authorised page, options etc.
//Route::get('/authorising', [AuthorisationController::class, 'index'])->name('admin.authorising');
//Route::get('/payments', [UserDashboardController::class, 'payments'])->name('admin.payments');
//Route::get('/options', [UserDashboardController::class, 'options'])->name('admin.options');

//Route::get('/active-file', [BaseboardController::class, 'activeFile'])->name('admin.active-file');
//
//Route::name('wizard.')->prefix('wizard')->group(function () {
//    Route::get('create-project', [WizardController::class, 'create'])->name('create');
//});

Route::name('project.')->prefix('project')->group(function () {
        Route::post('/create', [ProjectController::class, 'create'])->name('create');
        Route::get('/get', [ProjectController::class, 'show'])->name('show');
//
//    Route::name('folder.')->prefix('folder')->group(function () {
//        Route::post('/create', [])->name('create');
//        // this goes to the same delete function as delete file, it can be cleaned up later.
//        // it's just to make it clearer for me as i build this thing out.
//        Route::delete('/delete', [BaseboardController::class, 'deleteFile'])->name('delete');
//    });
    require 'web/files.php';
});

