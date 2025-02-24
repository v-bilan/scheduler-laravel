<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\Witness;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::paginate(10);
        return view('roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $witnesses = Witness::all();
        return view('roles.create', ['witnesses' => $witnesses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create($data);
        $role->witnesses()->attach($data['witnesses']);

        return redirect()->route('role.index')->with('success', 'Role was created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $roleWitnesses = $role->witnesses->pluck('id')->toArray();

        $witnesses = Witness::all();

        return view('roles.edit', [
            'role' => $role,
            'roleWitnesses' => $roleWitnesses,
            'witnesses' => $witnesses
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $role->update($data);
        $role->witnesses()->sync($data['witnesses']);

        return redirect()->route('role.index')->with('success', __('Role updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('role.index')->with('success', __('Role deleted successfully.'));
    }
}
