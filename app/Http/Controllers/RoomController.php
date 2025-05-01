<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Cinema;
use App\Http\Requests\RoomRequest;
use Illuminate\Http\Request;

class RoomController extends Controller
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
        return view('rooms.index', [
            'rooms' => Room::with('cinema')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('rooms.create', [
            'room' => new Room(),
            'cinemas' => Cinema::all(),
        ]);
    }

    public function store(RoomRequest $request)
    {
        Room::create(
            array_merge($request->validated(), ['user_id' => auth()->id()])
        );

        return redirect()
            ->route('room.index')
            ->with('ok', __('Room has been saved'));
    }

    public function show(Room $room)
    {
        return view('rooms.show', ['room' => $room]);
    }

    public function edit(Room $room)
    {
        if ($room->user_id && $room->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('rooms.edit', [
            'room' => $room,
            'cinemas' => Cinema::all(),
        ]);
    }

    public function update(RoomRequest $request, Room $room)
    {
        if ($room->user_id && $room->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $room->update(
            array_merge($request->validated(), ['user_id' => auth()->id()])
        );

        return redirect()
            ->route('room.index')
            ->with('ok', __('Room has been updated'));
    }

    public function destroy(Room $room)
    {
        if ($room->user_id && $room->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $room->delete();
        return response()->json();
    }
}
