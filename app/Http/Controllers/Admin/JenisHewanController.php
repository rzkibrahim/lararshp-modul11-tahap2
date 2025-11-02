<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewan = JenisHewan::orderBy('idjenis_hewan', 'asc')->get();
        return view('rshp.admin.DataMaster.jenis-hewan.index', compact('jenisHewan'));
    }

    public function create()
    {
        return view('rshp.admin.DataMaster.jenis-hewan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100', 
        ]);

        JenisHewan::create([
            'nama_jenis_hewan' => $request->nama_jenis_hewan, 
        ]);

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        return view('rshp.admin.DataMaster.jenis-hewan.edit', compact('jenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100', 
        ]);

        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->update([
            'nama_jenis_hewan' => $request->nama_jenis_hewan, 
        ]);

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->delete();

        return redirect()->route('admin.jenis-hewan.index')
            ->with('success', 'Jenis hewan berhasil dihapus.');
    }
}