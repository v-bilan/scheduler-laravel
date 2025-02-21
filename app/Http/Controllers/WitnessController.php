<?php

namespace App\Http\Controllers;

use App\Http\Requests\WitnessRequest;
use App\Models\Witness;

class WitnessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $witnesses = Witness::paginate(10);
        return view('witness.index', ['witnesses' => $witnesses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('witness.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WitnessRequest $request)
    {
        Witness::create($request->validated());
        return redirect()->route('witness.index')->with('success', 'Witness was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(witness $witness)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(witness $witness)
    {
        return view('witness.edit', compact('witness'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WitnessRequest $request, witness $witness)
    {
        $witness->update($request->validated());
        return redirect()->route('witness.index')->with('success', 'Witness was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(witness $witness)
    {
        $witness->delete();
        return redirect()->route('witness.index')->with('success', 'Witness was deleted!');
    }
}
