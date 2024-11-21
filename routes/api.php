<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MovieController;

Route::get('/search', [MovieController::class, 'search'])->name('api.search');
Route::get('/movies/{id}', [MovieController::class, 'details'])->name('api.details');
Route::get('/trending', [MovieController::class, 'trending'])->name('api.trending');


/*
Route::get('/search', [MovieController::class, 'search'])->name('api.search');
Route::get('/movies/{id}', [MovieController::class, 'details'])->name('api.details');
Route::get('/trending', [MovieController::class, 'trending'])->name('api.trending');
*/
/*
Route::middleware('api')->get('/search', [MovieController::class, 'search']);
Route::middleware('api')->get('/movies/{imdbID}', [MovieController::class, 'details']);
Route::middleware('api')->get('/trending', [MovieController::class, 'trending']);
*/