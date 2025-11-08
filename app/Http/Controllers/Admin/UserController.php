<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('iduser', 'asc')->get();
        return view('rshp.admin.DataMaster.user.index', compact('users'));
    }

    public function create()
    {
        return view('rshp.admin.DataMaster.user.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateUser($request);
        $this->createUser($data);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('rshp.admin.DataMaster.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $this->validateUser($request, $id);
        $this->updateUser($user, $data);

        return redirect()->route('admin.user.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus!');
    }

    // 🔹 Validasi input user
    protected function validateUser(Request $request, $id = null)
    {
        $emailRule = $id
            ? 'unique:user,email,' . $id . ',iduser'
            : 'unique:user,email';

        return $request->validate([
            'nama' => ['required', 'string', 'max:500'],
            'email' => ['required', 'email', 'max:200', $emailRule],
            'password' => $id
                ? 'nullable|string|min:3|confirmed'
                : 'required|string|min:3|confirmed',
        ]);
    }

    protected function createUser(array $data)
    {
        return User::create([
            'nama' => trim($data['nama']),
            'email' => trim($data['email']),
            'password' => Hash::make($data['password']),
        ]);
    }


    // 🔹 Update user
    protected function updateUser(User $user, array $data)
    {
        $updateData = [
            'nama' => $data['nama'],
            'email' => $data['email'],
        ];

        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);
        return $user;
    }
}
