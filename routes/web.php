<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\KeywordsController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\NetworkController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/movies', [MoviesController::class, 'index']);
Route::get('/movies/{id}/{movie}', [MoviesController::class, 'show']);

Route::get('/person', [PersonController::class, 'index']);
Route::get('/person/page/{page?}', [PersonController::class, 'index']);
Route::get('/person/{id}/{people}', [PersonController::class, 'show']);

Route::get('/tv', [TvController::class, 'index']);
Route::get('/tv/{id}/{tv}', [TvController::class, 'show']);

Route::get('/genre/{id}/{genre}/movie', [GenreController::class, 'movie']);
Route::get('/genre/{id}/{genre}/tv', [GenreController::class, 'tv']);

Route::get('/tv/{id}/{tv}/seasons', [SeasonsController::class, 'index']);
Route::get('/tv/{id}/season/{season}', [SeasonsController::class, 'show']);

Route::get('/tv/{id}/season/{season}/episode/{episode}', [EpisodeController::class, 'index']);

Route::get('/keyword/{id}/{keyword}/movie', [KeywordsController::class, 'movie']);
Route::get('/keyword/{id}/{keyword}/tv', [KeywordsController::class, 'tv']);

Route::get('/collection/{id}/{collection}', [CollectionController::class, 'index']);

Route::get('/network/{id}/{network}', [NetworkController::class, 'index']);
