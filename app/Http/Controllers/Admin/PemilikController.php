<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::with('user')->orderBy('idpemilik', 'asc')->get();
        
        // Perbaiki path view - sesuaikan dengan struktur folder
        return view('rshp.admin.DataMaster.pemilik.index', compact('pemiliks'));
        // Bukan: rshp.DataMaster.pemilik.index
    }

    public function create()
    {
        return view('rshp.admin.DataMaster.pemilik.create');
    }

    public function store(Request $request)
    {
        // Validation & Store logic
    }

    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('rshp.admin.DataMaster.pemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, $id)
    {
        // Validation & Update logic
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $pemilik->delete();
        
        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Pemilik berhasil dihapus');
    }
}