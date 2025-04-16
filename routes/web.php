<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ScreeningController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/artist', [ArtistController::class, 'index'])->name('artist.index');
Route::get('/artist/{artist}', [ArtistController::class, 'show'])->name(
    'artist.show'
);

Route::get('/movie', [MovieController::class, 'index'])->name('movie.index');
Route::get('/movie/{movie}', [MovieController::class, 'show'])->name(
    'movie.show'
);

Route::get('/country', [CountryController::class, 'index'])->name(
    'country.index'
);
Route::get('/country/{country}', [CountryController::class, 'show'])->name(
    'country.show'
);

Route::get('/cinema', [CinemaController::class, 'index'])->name('cinema.index');
Route::get('/cinema/{cinema}', [CinemaController::class, 'show'])->name(
    'cinema.show'
);

Route::get('/room', [RoomController::class, 'index'])->name('room.index');
Route::get('/room/{room}', [RoomController::class, 'show'])->name('room.show');

Route::get('/screening', [ScreeningController::class, 'index'])->name(
    'screening.index'
);
Route::get('/screening/{screening}', [
    ScreeningController::class,
    'show',
])->name('screening.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('artist', ArtistController::class)->except([
        'index',
        'show',
    ]);
    Route::resource('movie', MovieController::class)->except(['index', 'show']);
    Route::resource('country', CountryController::class)->except([
        'index',
        'show',
    ]);
    Route::resource('cinema', CinemaController::class)->except([
        'index',
        'show',
    ]);
    Route::resource('room', RoomController::class)->except(['index', 'show']);
    Route::resource('screening', ScreeningController::class)->except([
        'index',
        'show',
    ]);

    Route::prefix('movie')->group(function () {
        Route::get("{movie}/artists", [
            MovieController::class,
            "artists",
        ])->name("movie.artists");
        Route::post("{movie}/attach", [MovieController::class, "attach"])->name(
            "movie.attach"
        );
        Route::delete("{movie}/detach/{artist}", [
            MovieController::class,
            "detach",
        ])->name("movie.detach");
    });

    Route::prefix('cinema')->group(function () {
        Route::post('{cinema}/attach-movie', [
            CinemaController::class,
            'attachMovie',
        ])->name('cinema.attach.movie');
        Route::delete('{cinema}/detach-movie/{movie}', [
            CinemaController::class,
            'detachMovie',
        ])->name('cinema.detach.movie');
    });
});
