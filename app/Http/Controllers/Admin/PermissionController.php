<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index () {
        $permissions = Permission::orderBy('name')->get();

        return view('admin.permissions.index', ['permissions' => $permissions]);
    }

    public function create () {
        return view('admin.permissions.create');
    }

    public function store (Request $request) {
        $request->validate([
            'name' => 'required|string|unique:permissions',
        ]);
        Permission::create(['name' => $request->name]);

        return redirect()->route('admin.permissions.index')->with('success', 'Nouvelle permission ' . $request->name . ' créée.');
    }
}
