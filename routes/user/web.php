<?php

use App\Http\Controllers\BaseboardController;
use App\Http\Controllers\GoogleDriveConnectionController;
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
Route::name('baseboard.')->prefix('baseboard')->group(function () {
    Route::get('/', [BaseboardController::class, 'index'])->name('admin.baseboard');
    Route::get('/generate-auth', [GoogleDriveConnectionController::class, 'generateAuthRequest'])->name('admin.generate-auth');
    // Route to generate bearer token
    Route::post('/authorise', [GoogleDriveConnectionController::class, 'authorise'])->name('admin.authorise');
});




// Route to show authorised page, options etc.
//Route::get('/authorising', [AuthorisationController::class, 'index'])->name('admin.authorising');
//Route::get('/payments', [UserDashboardController::class, 'payments'])->name('admin.payments');
//Route::get('/options', [UserDashboardController::class, 'options'])->name('admin.options');

//Route::get('/active-file', [BaseboardController::class, 'activeFile'])->name('admin.active-file');
//
//Route::name('wizard.')->prefix('wizard')->group(function () {
//    Route::get('create-project', [WizardController::class, 'create'])->name('create');
//});

//Route::name('files.')->prefix('files')->group(function () {
//    Route::name('project.')->prefix('project')->group(function () {
//        Route::post('/create', [BaseboardController::class, 'createProject'])->name('create');
//        Route::get('/get', [BaseboardController::class, 'retrieveProject'])->name('get');
//    });
//    Route::name('folder.')->prefix('folder')->group(function () {
//        Route::post('/create', [BaseboardController::class, 'createFolder'])->name('create');
//        // this goes to the same delete function as delete file, it can be cleaned up later.
//        // it's just to make it clearer for me as i build this thing out.
//        Route::delete('/delete', [BaseboardController::class, 'deleteFile'])->name('delete');
//    });
//    Route::name('file.')->prefix('file')->group(function () {
//        Route::post('/create', [BaseboardController::class, 'createFile'])->name('create');
//        Route::post('/update', [BaseboardController::class, 'updateFile'])->name('update');
//        Route::delete('/delete', [BaseboardController::class, 'deleteFile'])->name('delete');
//    });
//});

