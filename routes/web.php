<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/top10', [HomeController::class, 'top10'])->name('top10');
Route::get('/rating', [HomeController::class, 'rate'])->name('rate');
Route::post('/rating', [HomeController::class, 'input_rating']);
Route::get('/get-book-by-author/{author_id}', [HomeController::class, 'getBookByAuthor'])->name('getBookByAuthor');