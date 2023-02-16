<?php

use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Projects Routes
|--------------------------------------------------------------------------
*/
Route::get('/create', [ProjectController::class, 'create'])->name('create');
Route::get('/store', [ProjectController::class, 'rejoin'])->name('store.page');
Route::post('/store', [ProjectController::class, 'store'])->name('store');
Route::get('/', [ProjectController::class, 'index'])->name('edit');
Route::get('/get', [ProjectController::class, 'show'])->name('show');
Route::delete('/delete/{project:project_id}', [ProjectController::class, 'delete'])->name('delete');
