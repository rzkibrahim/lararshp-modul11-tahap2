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
        // Validasi input
        $validatedData = $this->validateRasHewan($request);

        // Helper untuk menyimpan data
        $rasHewan = $this->createRasHewan($validatedData);

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
        $rasHewan = RasHewan::findOrFail($id);

        // Validasi input
        $validatedData = $this->validateRasHewan($request, $id);

        // Helper untuk update data
        $this->updateRasHewan($rasHewan, $validatedData);

        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras hewan berhasil diupdate.');
    }

    public function destroy($id)
    {
        $rasHewan = RasHewan::findOrFail($id);
        
        // Cek apakah ras hewan sedang digunakan di pet
        if ($rasHewan->pets()->count() > 0) {
            return redirect()->route('admin.ras-hewan.index')
                ->with('error', 'Ras hewan tidak dapat dihapus karena masih digunakan di data pet.');
        }

        $rasHewan->delete();

        return redirect()->route('admin.ras-hewan.index')
            ->with('success', 'Ras hewan berhasil dihapus.');
    }

    // ==================== HELPER METHODS ====================

    /**
     * Validasi data ras hewan
     */
    protected function validateRasHewan(Request $request, $id = null)
    {
        // Unique rule untuk kombinasi nama_ras dan idjenis_hewan
        $uniqueRule = $id ? 
            'unique:ras_hewan,nama_ras,' . $id . ',idras_hewan,idjenis_hewan,' . $request->idjenis_hewan : 
            'unique:ras_hewan,nama_ras,NULL,idras_hewan,idjenis_hewan,' . $request->idjenis_hewan;

        return $request->validate([
            'nama_ras' => [
                'required',
                'string',
                'max:100',
                'min:2',
                $uniqueRule
            ],
            'idjenis_hewan' => [
                'required',
                'exists:jenis_hewan,idjenis_hewan'
            ],
        ], [
            'nama_ras.required' => 'Nama ras wajib diisi.',
            'nama_ras.max' => 'Nama ras maksimal 100 karakter.',
            'nama_ras.min' => 'Nama ras minimal 2 karakter.',
            'nama_ras.unique' => 'Ras ini sudah ada untuk jenis hewan yang dipilih.',
            'idjenis_hewan.required' => 'Jenis hewan wajib dipilih.',
            'idjenis_hewan.exists' => 'Jenis hewan tidak valid.',
        ]);
    }

    /**
     * Helper untuk membuat ras hewan baru
     */
    protected function createRasHewan(array $data)
    {
        return RasHewan::create([
            'nama_ras' => $this->formatNamaRas($data['nama_ras']),
            'idjenis_hewan' => $data['idjenis_hewan'],
        ]);
    }

    /**
     * Helper untuk update ras hewan
     */
    protected function updateRasHewan(RasHewan $rasHewan, array $data)
    {
        $rasHewan->update([
            'nama_ras' => $this->formatNamaRas($data['nama_ras']),
            'idjenis_hewan' => $data['idjenis_hewan'],
        ]);

        return $rasHewan;
    }

    /**
     * Helper untuk format nama menjadi Title Case
     */
    protected function formatNamaRas($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }
}