<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Artist;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('movies.index', ['movies' => Movie::paginate(4)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Movie $movie)
    {
        return view('movies.create', [
            'movie' => $movie,
            'artists' => Artist::all(),
            'countries' => Country::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRequest $request)
    {
        $movie = Movie::create($request->validated());

        $poster = $request->file('poster');
        $filename =
            'poster_' . $movie->id . '.' . $poster->guessClientExtension();

        Image::read($poster)
            ->cover(180, 240)
            ->save(storage_path('app/public/uploads/posters/' . $filename));

        return redirect()
            ->route('movie.index')
            ->with('ok', __('Movie has been saved'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        $movie->load(['cinemas', 'actors']);
        return view('movies.show', [
            'movie' => $movie,
            'artists' => Artist::all(),
            'cast' => $movie->actors,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $movie->image_extension = $this->getImageExtension($movie->id);
        return view('movies.edit', [
            'movie' => $movie,
            'artists' => Artist::all(),
            'countries' => Country::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieRequest $request, Movie $movie)
    {
        $data = $request->validated();

        if ($request->hasFile('poster')) {
            if (
                $movie->poster &&
                Storage::exists(
                    'public/uploads/posters/poster_' . $movie->id . '.*'
                )
            ) {
                $oldFiles = glob(
                    storage_path(
                        'app/public/uploads/posters/poster_' . $movie->id . '.*'
                    )
                );
                foreach ($oldFiles as $file) {
                    unlink($file);
                }
            }

            $poster = $request->file('poster');
            $filename =
                'poster_' .
                $movie->id .
                '.' .
                $poster->getClientOriginalExtension();

            Image::read($poster)
                ->cover(180, 240)
                ->save(storage_path('app/public/uploads/posters/' . $filename));
        }

        $movie->update($data);

        return redirect()
            ->route('movie.index')
            ->with('ok', __('Movie has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json();
    }

    public function attach(Request $request, Movie $movie)
    {
        $movie->actors()->attach($request->get('actor_id'), [
            'role_name' => $request->get('role'),
        ]);

        return redirect()
            ->route('movie.show', $movie)
            ->with('ok', __('Actor has been attached to movie'));
    }

    public function detach(Movie $movie, Artist $artist)
    {
        $movie->actors()->detach($artist->id);

        return redirect()
            ->route('movie.show', $movie)
            ->with('ok', __('Actor has been detached from movie'));
    }

    private function getImageExtension($movieId)
    {
        $path = storage_path(
            'app/public/uploads/posters/poster_' . $movieId . '.*'
        );
        $files = glob($path);
        if (!empty($files)) {
            return pathinfo($files[0], PATHINFO_EXTENSION);
        }
        return null;
    }
}
