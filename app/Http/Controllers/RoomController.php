<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Cinema;
use App\Http\Requests\RoomRequest;
use Illuminate\Http\Request;

class RoomController extends Controller
{
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
        Room::create($request->validated());

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
        return view('rooms.edit', [
            'room' => $room,
            'cinemas' => Cinema::all(),
        ]);
    }

    public function update(RoomRequest $request, Room $room)
    {
        $room->update($request->validated());

        return redirect()
            ->route('room.index')
            ->with('ok', __('Room has been updated'));
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json();
    }
}
