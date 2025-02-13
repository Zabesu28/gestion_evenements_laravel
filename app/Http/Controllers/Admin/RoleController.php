<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index () {
        $roles = Role::with('permissions')->orderBy('name')->get();

        return view('admin.roles.index', ['roles' => $roles]);
    }

    public function create () {
        return view('admin.roles.create');
    }

    public function store (Request $request) {
        $request->validate([
            'name' => 'required|string|unique:roles',
        ]);
        Role::create(['name' => $request->name]);

        return redirect()->route('admin.roles.index')->with('success', 'Nouveau rôle ' . $request->name . ' créé.');
    }

    public function show (Role $role) {
        $permissions = Permission::all();
        return view('admin.roles.show', ['role' => $role, 'permissions' => $permissions]);
    }

    public function updatePermissions (Request $request, Role $role) {
        $role->syncPermissions([$request->input('permissions')]);
        return redirect()->route('admin.roles.index')->with('success', 'Permissions pour le rôle  ' . $role->name . ' mises à jour.');
    }

    public function destroy ($id) 
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Le role a bien été supprimé.');
    }
}
