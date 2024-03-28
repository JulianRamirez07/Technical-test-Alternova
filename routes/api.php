<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReductionController;
use App\Http\Controllers\SerieController;
// use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Route to login (accessible to everyone)
Route::post('/login', [AuthController::class, 'login']);

// Routes protected by authentication
Route::middleware(['auth:sanctum'])->group(function () {
    // Resource routes for ratings and comments
    Route::resource('/rating', RatingController::class);
    Route::resource('/comment', CommentController::class);

    // Routes to list movies and series
    Route::get('/movies/alphabetical', [MovieController::class, 'getMoviesAlphabetically']);
    Route::get('/movies/sorted-by-rating', [MovieController::class, 'getMoviesSortedByRating']);
    Route::get('/series/alphabetical', [SerieController::class, 'getSeriesAlphabetically']);
    Route::get('/series/sorted-by-rating', [SerieController::class, 'getSeriesSortedByRating']);
});

// Routes that should only be accessible by administrators
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::resource('/movie', MovieController::class);
    Route::resource('/serie', SerieController::class);
});

// Extra endpoint
Route::get('/reduce-string', [ReductionController::class, 'reduceString']);