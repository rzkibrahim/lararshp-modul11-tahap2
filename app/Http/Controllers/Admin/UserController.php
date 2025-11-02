<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Pakai 'roleUser.role' untuk tampilan detail management
        $users = User::with(['roleUser.role'])->get();
        
        return view('rshp.admin.DataMaster.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        // Validation & Store logic
    }

    public function edit($id)
    {
        $user = User::with(['roleUser.role'])->findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validation & Update logic
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect()->route('admin.user.index')
            ->with('success', 'User berhasil dihapus');
    }
}