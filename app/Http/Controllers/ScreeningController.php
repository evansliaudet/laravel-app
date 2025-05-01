<?php

namespace App\Http\Controllers;

use App\Models\Screening;
use App\Models\Movie;
use App\Models\Room;
use App\Http\Requests\ScreeningRequest;

class ScreeningController extends Controller
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
        Screening::create(
            array_merge($request->validated(), ['user_id' => auth()->id()])
        );

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
        if ($screening->user_id && $screening->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('screenings.edit', [
            'screening' => $screening,
            'movies' => Movie::all(),
            'rooms' => Room::with('cinema')->get(),
        ]);
    }

    public function update(ScreeningRequest $request, Screening $screening)
    {
        if ($screening->user_id && $screening->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $screening->update(
            array_merge($request->validated(), ['user_id' => auth()->id()])
        );

        return redirect()
            ->route('screening.index')
            ->with('ok', __('Screening has been updated'));
    }

    public function destroy(Screening $screening)
    {
        if ($screening->user_id && $screening->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $screening->delete();
        return response()->json();
    }
}
