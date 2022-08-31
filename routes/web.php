<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/collect-data', [MainController::class, 'collectData'])->name('collectData');
Route::get('/search', [MainController::class, 'search'])->name('search');
Route::post('/search', [MainController::class, 'searchPost'])->name('searchPost');

