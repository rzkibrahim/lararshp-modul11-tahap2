<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        // ✅ PERBAIKI path view - tambahkan 'admin'
        return view('rshp.admin.DataMaster.role.index', compact('roles'));
    }

    public function create()
    {
        return view('rshp.admin.DataMaster.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_role' => 'required|string|max:100|unique:role,nama_role'
        ], [
            'nama_role.required' => 'Nama role wajib diisi',
            'nama_role.unique' => 'Nama role sudah ada',
            'nama_role.max' => 'Nama role maksimal 100 karakter'
        ]);

        Role::create([
            'nama_role' => $request->nama_role
        ]);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil ditambahkan');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('rshp.admin.DataMaster.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'nama_role' => 'required|string|max:100|unique:role,nama_role,' . $id . ',idrole'
        ], [
            'nama_role.required' => 'Nama role wajib diisi',
            'nama_role.unique' => 'Nama role sudah ada',
            'nama_role.max' => 'Nama role maksimal 100 karakter'
        ]);

        $role->update([
            'nama_role' => $request->nama_role
        ]);

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil diupdate');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        
        // Cek apakah role sedang digunakan
        if ($role->users()->count() > 0) {
            return redirect()->route('admin.role.index')
                ->with('error', 'Role tidak dapat dihapus karena sedang digunakan oleh user');
        }

        $role->delete();

        return redirect()->route('admin.role.index')
            ->with('success', 'Role berhasil dihapus');
    }
}