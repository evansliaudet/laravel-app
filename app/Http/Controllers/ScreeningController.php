<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Models\Movie;
use App\Models\Room;
use App\Http\Requests\ScreeningRequest;

class ScreeningController extends Controller
{
    public function index()
    {
        return view('screenings.index', [
            'screenings' => Screening::with(['movie', 'room.cinema'])
                ->orderBy('screening_time')
                ->paginate(10),
        ]);
    }

    public function create()
    {
        return view('screenings.create', [
            'screening' => new Screening(),
            'movies' => Movie::all(),
            'rooms' => Room::with('cinema')->get(),
        ]);
    }

    public function store(ScreeningRequest $request)
    {
        Screening::create($request->validated());

        return redirect()
            ->route('screening.index')
            ->with('ok', __('Screening has been saved'));
    }

    public function show(Screening $screening)
    {
        $screening->load(['movie', 'room.cinema']);
        return view('screenings.show', ['screening' => $screening]);
    }

    public function edit(Screening $screening)
    {
        return view('screenings.edit', [
            'screening' => $screening,
            'movies' => Movie::all(),
            'rooms' => Room::with('cinema')->get(),
        ]);
    }

    public function update(ScreeningRequest $request, Screening $screening)
    {
        $screening->update($request->validated());

        return redirect()
            ->route('screening.index')
            ->with('ok', __('Screening has been updated'));
    }

    public function destroy(Screening $screening)
    {
        $screening->delete();
        return response()->json();
    }
}
