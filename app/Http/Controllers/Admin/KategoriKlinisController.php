<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::with('kategori')->get();
        return view('rshp.admin.DataMaster.kategori-klinis.index', compact('kategoriKlinis'));
    }

    public function create()
    {
        return view('rshp.admin.DataMaster.kategori-klinis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori_klinis' => 'required|string|max:50|unique:kategori_klinis,nama_kategori_klinis'
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 50 karakter'
        ]);

        KategoriKlinis::create([
            'nama_kategori_klinis' => $request->nama_kategori_klinis
        ]);

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori Klinis berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        return view('rshp.admin.DataMaster.kategori-klinis.edit', compact('kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);

        $request->validate([
            'nama_kategori_klinis' => 'required|string|max:50|unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis'
        ], [
            'nama_kategori_klinis.required' => 'Nama kategori klinis wajib diisi',
            'nama_kategori_klinis.unique' => 'Nama kategori klinis sudah ada',
            'nama_kategori_klinis.max' => 'Nama kategori klinis maksimal 50 karakter'
        ]);

        $kategoriKlinis->update([
            'nama_kategori_klinis' => $request->nama_kategori_klinis
        ]);

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori Klinis berhasil diupdate');
    }

    public function destroy($id)
    {
        $kategoriKlinis = KategoriKlinis::findOrFail($id);
        
        if ($kategoriKlinis->kodeTindakanTerapi()->count() > 0) {
            return redirect()->route('admin.kategori-klinis.index')
                ->with('error', 'Kategori Klinis tidak dapat dihapus karena masih digunakan');
        }

        $kategoriKlinis->delete();

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori Klinis berhasil dihapus');
    }
}