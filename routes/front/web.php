<?php

use App\Http\Controllers\Front\HomePageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FrontEnd Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/details', [HomePageController::class, 'details'])->name('details');
Route::get('/pricing', [HomePageController::class, 'pricing'])->name('pricing');
Route::get('/contact', [HomePageController::class, 'contact'])->name('contact');
