<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $tindakanTerapi = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('rshp.admin.DataMaster.kode-tindakan-terapi.index', compact('tindakanTerapi'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('rshp.admin.DataMaster.kode-tindakan-terapi.create', compact('kategori', 'kategoriKlinis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:5|unique:kode_tindakan_terapi,kode',
            'deskripsi_tindakan_terapi' => 'required|string|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis'
        ], [
            'kode.required' => 'Kode wajib diisi',
            'kode.unique' => 'Kode sudah digunakan',
            'deskripsi_tindakan_terapi.required' => 'Deskripsi wajib diisi',
            'idkategori.required' => 'Kategori wajib dipilih',
            'idkategori_klinis.required' => 'Kategori klinis wajib dipilih'
        ]);

        KodeTindakanTerapi::create($request->all());

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode Tindakan/Terapi berhasil ditambahkan');
    }

    public function edit($id)
    {
        $tindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('rshp.admin.DataMaster.kode-tindakan-terapi.edit', compact('tindakanTerapi', 'kategori', 'kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $tindakanTerapi = KodeTindakanTerapi::findOrFail($id);

        $request->validate([
            'kode' => 'required|string|max:5|unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi',
            'deskripsi_tindakan_terapi' => 'required|string|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis'
        ]);

        $tindakanTerapi->update($request->all());

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode Tindakan/Terapi berhasil diupdate');
    }

    public function destroy($id)
    {
        $tindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $tindakanTerapi->delete();

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode Tindakan/Terapi berhasil dihapus');
    }
}