<?php

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
////
//Route::name('wizard.')->prefix('wizard')->group(function () {
//    Route::get('stage-one', [ProjectController::class, 'stage-one'])->name('stage-one');
//});

Route::name('project.')->prefix('project')->group(function () {
    Route::get('/create', [ProjectController::class, 'create'])->name('create');
    Route::post('/store', [ProjectController::class, 'store'])->name('store');
    Route::get('/', [ProjectController::class, 'index'])->name('edit');
    Route::get('/get', [ProjectController::class, 'show'])->name('show');
    Route::delete('/delete/{project:project_id}', [ProjectController::class, 'delete'])->name('delete');

    require 'web/folders.php';
    require 'web/files.php';
});
