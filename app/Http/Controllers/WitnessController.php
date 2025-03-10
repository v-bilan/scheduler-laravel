<?php

namespace App\Http\Controllers;

use App\Http\Requests\WitnessRequest;
use App\Models\Role;
use App\Models\Witness;

class WitnessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $witnesses = Witness::orderBy('full_name')->paginate(10);
        return view('witness.index', ['witnesses' => $witnesses]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('witness.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WitnessRequest $request)
    {
        $data = $request->validated();
        $witness = Witness::create($data);
        $witness->roles()->attach($data['roles'] ?? []);

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
        $roles = Role::all();
        $witnessRoles = $witness->roles->pluck('id')->toArray();
        return view('witness.edit', compact('witness', 'roles', 'witnessRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WitnessRequest $request, witness $witness)
    {
        $data = $request->validated();
        $witness->update($data);
        $witness->roles()->sync($data['roles']);
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
