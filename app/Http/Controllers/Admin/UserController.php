<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index() 
    {
        $users = User::all();
        $roles = Role::all();

        return view('admin.users.index', ['users' => $users, 'roles' => $roles]);
    }

    public function updateRole (Request $request, $id) 
    {
        $user = User::findOrFail($id);
        $role = $request->input('role');

        if($role && Role::where('name', $role)->exists()) {
            $user->syncRoles([$role]);
            return redirect()->route('admin.users.index')->with('success', 'Mise à jour du rôle.');
        }
        return redirect()->route('admin.users.index')->with('error', 'Une erreur inattendue s\'est produite.');


    }

    public function destroy ($id) 
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'L\'utilisateur a bien été supprimé.');
    }
}