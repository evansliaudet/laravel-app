<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('artist', ArtistController::class);
    Route::resource('movie', MovieController::class);
    Route::resource('country', CountryController::class);

    Route::prefix('movie')->group(function () {
        Route::get("{movie}/artists", [MovieController::class, "artists"])->name("movie.artists");
        Route::post("{movie}/attach", [MovieController::class,"attach"])->name("movie.attach");
        Route::delete("{movie}/detach/{artist}", [MovieController::class,"detach"])->name("movie.detach");
    });
});