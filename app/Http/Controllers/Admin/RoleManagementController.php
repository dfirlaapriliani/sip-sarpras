<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleManagementController extends Controller
{
    // LIST USER
    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.role-management.index', compact('users'));
    }

    // SHOW DETAIL USER
    public function show($id)
    {
        $user  = User::with('role')->findOrFail($id);
        $roles = Role::all();

        return view('admin.role-management.show', compact('user', 'roles'));
    }

    // UPDATE ROLE
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id_role'
        ]);

        $user = User::findOrFail($id);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()
            ->route('admin.rolemanagement.show', $id)
            ->with('success', 'Role berhasil diupdate');
    }

    // HAPUS USER
    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()
            ->route('admin.rolemanagement.index')
            ->with('success', 'User berhasil dihapus');
    }
}
