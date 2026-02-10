<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleManagementController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.role-management.index', compact('users'));
    }
    
    public function show($id)
    {
        $user = User::with('role')->findOrFail($id);
        $roles = Role::all();
        return view('admin.role-management.show', compact('user', 'roles'));
    }
    
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id_role'
        ]);
        
        $user = User::findOrFail($id);
        $user->role_id = $request->role_id;
        $user->save();
        
        return redirect()->route('admin.rolemanagement.show', $id)
            ->with('success', 'Role berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $userName = $user->name;
            $user->delete();
            
            return redirect()->route('admin.rolemanagement.index')
                ->with('success', "User {$userName} berhasil dihapus!");
        } catch (\Exception $e) {
            return redirect()->route('admin.rolemanagement.index')
                ->with('error', 'Gagal menghapus user: ' . $e->getMessage());
        }
    }
}