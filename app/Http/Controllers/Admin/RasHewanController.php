<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenisHewan')
            ->orderBy('idras_hewan', 'asc')
            ->get();
        
        return view('rshp.admin.DataMaster.ras-hewan.index', compact('rasHewan'));
    }

    public function create()
    {
        $jenisHewan = JenisHewan::orderBy('nama_jenis_hewan', 'asc')->get();
        return view('rshp.admin.DataMaster.ras-hewan.create', compact('jenisHewan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);

        RasHewan::create($request->all());

        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rasHewan = RasHewan::findOrFail($id);
        $jenisHewan = JenisHewan::orderBy('nama_jenis_hewan', 'asc')->get();
        return view('rshp.admin.DataMaster.ras-hewan.edit', compact('rasHewan', 'jenisHewan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);

        $rasHewan = RasHewan::findOrFail($id);
        $rasHewan->update($request->all());

        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras hewan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $rasHewan = RasHewan::findOrFail($id);
        $rasHewan->delete();

        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras hewan berhasil dihapus.');
    }
}