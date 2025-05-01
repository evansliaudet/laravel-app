<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
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
        return view('countries.index', ['countries' => Country::paginate(3)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Country $country)
    {
        return view('countries.create', ['country' => $country]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        Country::create(
            array_merge($request->validated(), ['user_id' => auth()->id()])
        );

        return redirect()
            ->route('country.index')
            ->with('ok', __('Country has been saved'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        if ($country->user_id && $country->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('countries.edit', ['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country)
    {
        if ($country->user_id && $country->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $data = array_merge($request->validated(), ['user_id' => auth()->id()]);

        $country->update($data);

        return redirect()
            ->route('country.index')
            ->with('ok', __('Country has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        if ($country->user_id && $country->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $country->delete();

        return response()->json();
    }
}
