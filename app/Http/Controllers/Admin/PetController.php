<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])->get();
        
        // PERBAIKI INI - tambahkan 'admin' di path
        return view('rshp.admin.DataMaster.pet.index', compact('pets'));
        // Bukan: rshp.DataMaster.pet.index
    }

    public function create()
    {
        return view('rshp.admin.DataMaster.pet.create');
    }

    public function store(Request $request)
    {
        // Validation & Store logic
    }

    public function edit($id)
    {
        $pet = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])->findOrFail($id);
        return view('rshp.admin.DataMaster.pet.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        // Validation & Update logic
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();
        
        return redirect()->route('admin.pet.index')
            ->with('success', 'Pet berhasil dihapus');
    }
}