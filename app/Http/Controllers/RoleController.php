<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::latest()->paginate(25);

        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::latest()->get();

        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|unique:roles,name',
            'permission'  => 'array|nullable',
            'permission.*' => 'string'
        ]);

        // Create the role with only the fields belonging to the Model
        $role = Role::create([
            'name' => $validated['name'],
        ]);

        // Sync permissions
        $role->syncPermissions($validated['permission'] ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role added successfully.');
    }

    public function edit(Role $role)
    {
        $hasPermission = $role->permissions->pluck('name');
        $permissions = Permission::latest()->get();

        return view('roles.edit', compact('role', 'permissions', 'hasPermission'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|unique:roles,name,' . $role->id,
            'permission'  => 'array|nullable',
            'permission.*' => 'string'
        ]);

        // Only update the fields that belong to the role model
        $role->update([
            'name' => $validated['name'],
        ]);

        // Sync permissions (empty array clears permissions)
        $role->syncPermissions($validated['permission'] ?? []);

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Role deleted successfully.');
    }
}
