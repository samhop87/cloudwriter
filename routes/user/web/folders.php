<?php

use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Folders Routes
|--------------------------------------------------------------------------
*/
Route::name('folder.')->prefix('folder')->group(function () {
    Route::post('/create', [FolderController::class, 'create'])->name('create');
//    Route::get('/show', [FolderController::class, 'show'])->name('show');
//    Route::put('/update', [FolderController::class, 'update'])->name('update');
    Route::delete('/delete', [FolderController::class, 'delete'])->name('delete');
});
