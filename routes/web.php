<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/movies/search', [MovieController::class, 'index'])->name('movies.search');
Route::post('/movies/search', [MovieController::class, 'search'])->name('movies.search.results');
