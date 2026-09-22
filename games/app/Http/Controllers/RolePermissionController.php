<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();

        return view('admin.role-permissions.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $role = Role::findOrFail($validated['role_id']);
        $permission = Permission::findOrFail($validated['permission_id']);

        if ($role->hasPermissionTo($permission)) {
            return back()->with('error', 'Deze permissie is al aan deze rol gekoppeld.');
        }

        $role->givePermissionTo($permission);

        return redirect()->route('admin.role-permissions.index')
            ->with('success', 'Permissie aan rol gekoppeld.');
    }

    public function destroy(Role $role, Permission $permission)
    {
        $role->revokePermissionTo($permission);

        return redirect()->route('admin.role-permissions.index')
            ->with('success', 'Koppeling verwijderd.');
    }
}
