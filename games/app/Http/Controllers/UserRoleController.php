<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->orderBy('name')->get();
        $roles = Role::orderBy('name')->get();

        return view('admin.user-roles.index', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($validated['user_id']);
        $role = Role::findOrFail($validated['role_id']);

        if ($user->hasRole($role)) {
            return back()->with('error', 'Deze rol is al aan deze gebruiker gekoppeld.');
        }

        $user->assignRole($role);

        return redirect()->route('admin.user-roles.index')
            ->with('success', 'Rol aan gebruiker gekoppeld.');
    }

    public function destroy(User $user, Role $role)
    {
        $user->removeRole($role);

        return redirect()->route('admin.user-roles.index')
            ->with('success', 'Koppeling verwijderd.');
    }
}
