<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        // ✅ PERBAIKI - tambahkan 'admin'
        return view('rshp.admin.DataMaster.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('rshp.admin.DataMaster.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori'
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.unique' => 'Nama kategori sudah ada',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('rshp.admin.DataMaster.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $id . ',idkategori'
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi',
            'nama_kategori.unique' => 'Nama kategori sudah ada',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter'
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        
        if ($kategori->kodeTindakanTerapi()->count() > 0) {
            return redirect()->route('admin.kategori.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan');
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}