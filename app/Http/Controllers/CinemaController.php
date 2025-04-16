<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Movie;
use App\Http\Requests\CinemaRequest;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    public function index()
    {
        return view('cinemas.index', ['cinemas' => Cinema::paginate(10)]);
    }

    public function create()
    {
        return view('cinemas.create', ['cinema' => new Cinema()]);
    }

    public function store(CinemaRequest $request)
    {
        Cinema::create($request->validated());

        return redirect()
            ->route('cinema.index')
            ->with('ok', __('Cinema has been saved'));
    }

    public function show(Cinema $cinema)
    {
        $cinema->load('movies');
        $availableMovies = Movie::whereNotIn(
            'id',
            $cinema->movies->pluck('id')
        )->get();

        return view('cinemas.show', [
            'cinema' => $cinema,
            'availableMovies' => $availableMovies,
        ]);
    }

    public function edit(Cinema $cinema)
    {
        return view('cinemas.edit', ['cinema' => $cinema]);
    }

    public function update(CinemaRequest $request, Cinema $cinema)
    {
        $cinema->update($request->validated());

        return redirect()
            ->route('cinema.index')
            ->with('ok', __('Cinema has been updated'));
    }

    public function destroy(Cinema $cinema)
    {
        $cinema->delete();
        return response()->json();
    }

    public function attachMovie(Request $request, Cinema $cinema)
    {
        $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'screening_time' => 'required|date',
        ]);

        $cinema->movies()->attach($request->movie_id, [
            'screening_time' => $request->screening_time,
        ]);

        return redirect()
            ->route('cinema.show', $cinema)
            ->with('ok', __('Movie has been scheduled'));
    }

    public function detachMovie(Cinema $cinema, Movie $movie)
    {
        $cinema->movies()->detach($movie->id);

        return redirect()
            ->route('cinema.show', $cinema)
            ->with('ok', __('Movie has been removed from schedule'));
    }
}
