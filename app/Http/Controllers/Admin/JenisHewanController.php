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
        $validateData = $this->validateJenisHewan($request);

        $jenisHewan = $this->createJenisHewan($validateData);

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

    public function validateJenisHewan(Request $request, $id = null)
    {
        $uniqueRule = $id
            ? 'unique:jenis_hewan,nama_jenis_hewan,' . $id . ',idjenis_hewan'
            : 'unique:jenis_hewan,nama_jenis_hewan';

        return $request->validate([
            'nama_jenis_hewan' => ['required', 'string', 'max:255', 'min:3', $uniqueRule],
        ], [
            'nama_jenis_hewan.required' => 'Nama jenis hewan wajib diisi.',
            'nama_jenis_hewan.unique' => 'Nama jenis hewan sudah ada.',
            'nama_jenis_hewan.max' => 'Nama jenis hewan maksimal 255 karakter.',
            'nama_jenis_hewan.min' => 'Nama jenis hewan minimal 3 karakter.',
            'nama_jenis_hewan.string' => 'Nama jenis hewan sudah ada',
        ]);
    }

    public function createJenisHewan(array $data)
    {
        try {
            return JenisHewan::create([
                'nama_jenis_hewan' => trim(ucwords(strtolower($data['nama_jenis_hewan']))),
            ]);
        } catch (\Exception $e) {
            // Log the error message
            \Log::error('Error creating Jenis Hewan: ' . $e->getMessage());
            // Optionally, you can throw a custom exception or return null
            throw new \Exception('Failed to create Jenis Hewan.');
        }
    }

    public function formatJenisHewanName($name)
    {
        return trim(ucwords(strtolower($name)));
    }
}
