<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArtistRequest;
use App\Models\Artist;
use App\Models\Country;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'create',
            'store',
            'edit',
            'update',
            'destroy',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::paginate(3);
        foreach ($artists as $artist) {
            $artist->image_extension = $this->getImageExtension($artist->id);
        }
        return view('artists.index', ['artists' => $artists]);
    }

    private function getImageExtension($artistId)
    {
        $path = storage_path(
            'app/public/uploads/artists/artist_' . $artistId . '.*'
        );
        $files = glob($path);
        if (!empty($files)) {
            return pathinfo($files[0], PATHINFO_EXTENSION);
        }
        return null;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Artist $artist)
    {
        return view('artists.create', [
            'artist' => $artist,
            'countries' => Country::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArtistRequest $request, Artist $artist)
    {
        $artist = Artist::create(
            array_merge($request->validated(), ['user_id' => auth()->id()])
        );

        $poster = $request->file('poster');
        $filename =
            'artist_' . $artist->id . '.' . $poster->guessClientExtension();

        Image::read($poster)
            ->cover(180, 240)
            ->save(storage_path('app/public/uploads/artists/' . $filename));

        return redirect()
            ->route('artist.index')
            ->with('ok', __('Artist has been saved'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        $artist->image_extension = $this->getImageExtension($artist->id);
        $artist->load(['country', 'hasPlayed']);

        return view('artists.show', ['artist' => $artist]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        if ($artist->user_id && $artist->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('artists.edit', [
            'artist' => $artist,
            'countries' => Country::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArtistRequest $request, Artist $artist)
    {
        if ($artist->user_id && $artist->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $data = array_merge($request->validated(), ['user_id' => auth()->id()]);

        if ($request->hasFile('poster')) {
            if (
                $artist->poster &&
                Storage::exists('public/uploads/artists/' . $artist->poster)
            ) {
                Storage::delete('public/uploads/artists/' . $artist->poster);
            }

            $poster = $request->file('poster');
            $filename =
                'artist_' .
                $artist->id .
                '.' .
                $poster->getClientOriginalExtension();

            Image::read($poster)
                ->cover(180, 240)
                ->save(storage_path('app/public/uploads/artists/' . $filename));
        }

        $artist->update($data);

        return redirect()
            ->route('artist.index')
            ->with('ok', __('Artist has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        if ($artist->user_id && $artist->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $artist->hasPlayed()->detach();
        $artist->save();

        $artist->delete();

        return response()->json();
    }
}
