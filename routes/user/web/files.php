<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Files Routes
|--------------------------------------------------------------------------
*/
Route::name('file.')->prefix('file')->group(function () {
    Route::get('/edit', [FileController::class, 'edit'])->name('edit');
    Route::post('/create', [FileController::class, 'create'])->name('create');
    Route::get('{file:file_id}/show', [FileController::class, 'show'])->name('show');
    Route::put('/update', [FileController::class, 'update'])->name('update');
    Route::delete('/delete', [FileController::class, 'delete'])->name('delete');
});
