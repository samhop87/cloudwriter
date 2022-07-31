<?php
//
//use App\Http\Controllers\User\AuthorisationController;
//use App\Http\Controllers\User\BaseboardController;
//use App\Http\Controllers\User\UserDashboardController;
//use App\Http\Controllers\User\WizardController;
//use Illuminate\Support\Facades\Route;
//
///*
//|--------------------------------------------------------------------------
//| User Routes
//|--------------------------------------------------------------------------
//|
//| These are the routes for a user's dashboard.
//|
//*/
//
//Route::middleware(['middleware' => 'auth'])->group(function () {
//    // refactor this to be in its own controller
//    Route::get('/baseboard', [BaseboardController::class, 'index'])->name('admin.baseboard');
//    Route::get('/new-baseboard', [BaseboardController::class, 'second'])->name('admin.new.baseboard');
//    // Route that gets hit from the authorise app button
//    Route::get('/baseboard/auth', [BaseboardController::class, 'authoriseUserDrive'])->name('admin.auth');
//    // Route to generate bearer token
//    Route::get('/authorise', [AuthorisationController::class, 'authorise'])->name('admin.authorise');
//    // Route to show authorised page, options etc.
//    Route::get('/authorising', [AuthorisationController::class, 'index'])->name('admin.authorising');
//    Route::get('/payments', [UserDashboardController::class, 'payments'])->name('admin.payments');
//    Route::get('/options', [UserDashboardController::class, 'options'])->name('admin.options');
//
//    Route::get('/active-file', [BaseboardController::class, 'activeFile'])->name('admin.active-file');
//
//    Route::name('wizard.')->prefix('wizard')->group(function() {
//        Route::get('create-project', [WizardController::class, 'create'])->name('create');
//    });
//
//    Route::name('files.')->prefix('files')->group(function() {
//        Route::name('project.')->prefix('project')->group(function() {
//            Route::post('/create', [BaseboardController::class, 'createProject'])->name('create');
//            Route::get('/get', [BaseboardController::class, 'retrieveProject'])->name('get');
//        });
//        Route::name('folder.')->prefix('folder')->group(function() {
//            Route::post('/create', [BaseboardController::class, 'createFolder'])->name('create');
//            // this goes to the same delete function as delete file, it can be cleaned up later.
//            // it's just to make it clearer for me as i build this thing out.
//            Route::delete('/delete', [BaseboardController::class, 'deleteFile'])->name('delete');
//        });
//        Route::name('file.')->prefix('file')->group(function() {
//            Route::post('/create', [BaseboardController::class, 'createFile'])->name('create');
//            Route::post('/update', [BaseboardController::class, 'updateFile'])->name('update');
//            Route::delete('/delete', [BaseboardController::class, 'deleteFile'])->name('delete');
//        });
//    });
//});
