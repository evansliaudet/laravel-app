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

// Public routes
Route::get('/movie', [MovieController::class, 'index'])->name('movie.index');
Route::get('/movie/{movie}', [MovieController::class, 'show'])->name(
    'movie.show'
);

Route::get('/artist', [ArtistController::class, 'index'])->name('artist.index');
Route::get('/artist/{artist}', [ArtistController::class, 'show'])->name(
    'artist.show'
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

    // Define individual protected routes instead of using resource with except
    // Movie routes
    Route::get('movie/create', [MovieController::class, 'create'])->name(
        'movie.create'
    );
    Route::post('movie', [MovieController::class, 'store'])->name(
        'movie.store'
    );
    Route::get('movie/{movie}/edit', [MovieController::class, 'edit'])->name(
        'movie.edit'
    );
    Route::put('movie/{movie}', [MovieController::class, 'update'])->name(
        'movie.update'
    );
    Route::delete('movie/{movie}', [MovieController::class, 'destroy'])->name(
        'movie.destroy'
    );

    // Artist routes
    Route::get('artist/create', [ArtistController::class, 'create'])->name(
        'artist.create'
    );
    Route::post('artist', [ArtistController::class, 'store'])->name(
        'artist.store'
    );
    Route::get('artist/{artist}/edit', [ArtistController::class, 'edit'])->name(
        'artist.edit'
    );
    Route::put('artist/{artist}', [ArtistController::class, 'update'])->name(
        'artist.update'
    );
    Route::delete('artist/{artist}', [
        ArtistController::class,
        'destroy',
    ])->name('artist.destroy');

    // Country routes
    Route::get('country/create', [CountryController::class, 'create'])->name(
        'country.create'
    );
    Route::post('country', [CountryController::class, 'store'])->name(
        'country.store'
    );
    Route::get('country/{country}/edit', [
        CountryController::class,
        'edit',
    ])->name('country.edit');
    Route::put('country/{country}', [CountryController::class, 'update'])->name(
        'country.update'
    );
    Route::delete('country/{country}', [
        CountryController::class,
        'destroy',
    ])->name('country.destroy');

    // Cinema routes
    Route::get('cinema/create', [CinemaController::class, 'create'])->name(
        'cinema.create'
    );
    Route::post('cinema', [CinemaController::class, 'store'])->name(
        'cinema.store'
    );
    Route::get('cinema/{cinema}/edit', [CinemaController::class, 'edit'])->name(
        'cinema.edit'
    );
    Route::put('cinema/{cinema}', [CinemaController::class, 'update'])->name(
        'cinema.update'
    );
    Route::delete('cinema/{cinema}', [
        CinemaController::class,
        'destroy',
    ])->name('cinema.destroy');

    // Room routes
    Route::get('room/create', [RoomController::class, 'create'])->name(
        'room.create'
    );
    Route::post('room', [RoomController::class, 'store'])->name('room.store');
    Route::get('room/{room}/edit', [RoomController::class, 'edit'])->name(
        'room.edit'
    );
    Route::put('room/{room}', [RoomController::class, 'update'])->name(
        'room.update'
    );
    Route::delete('room/{room}', [RoomController::class, 'destroy'])->name(
        'room.destroy'
    );

    // Screening routes
    Route::get('screening/create', [
        ScreeningController::class,
        'create',
    ])->name('screening.create');
    Route::post('screening', [ScreeningController::class, 'store'])->name(
        'screening.store'
    );
    Route::get('screening/{screening}/edit', [
        ScreeningController::class,
        'edit',
    ])->name('screening.edit');
    Route::put('screening/{screening}', [
        ScreeningController::class,
        'update',
    ])->name('screening.update');
    Route::delete('screening/{screening}', [
        ScreeningController::class,
        'destroy',
    ])->name('screening.destroy');

    // Special movie routes
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
});
