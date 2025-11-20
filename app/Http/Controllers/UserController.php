<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view users', only: ['index']),
            new Middleware('permission:edit users', only: ['edit', 'update']),
            new Middleware('permission:create users', only: ['create', 'store']),
            new Middleware('permission:delete users', only: ['destroy']),
        ];
    }

    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function edit(User $user)
    {
        $roles = Role::orderBy('name', 'asc')->get();
        $hasRoles = $user->roles->pluck('id');

        return view('users.edit', compact('user', 'roles', 'hasRoles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'role'  => 'nullable|array',
            'role.*' => 'string',
        ]);

        // update only the model attributes
        $user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ]);

        // sync roles safely
        $user->syncRoles($validated['role'] ?? []);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
