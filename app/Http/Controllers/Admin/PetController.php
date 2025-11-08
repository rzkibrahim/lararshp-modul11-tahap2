<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])
            ->orderBy('idpet', 'desc')
            ->get();

        return view('rshp.admin.DataMaster.pet.index', compact('pets'));
    }

    public function create()
    {
        $rasHewan = RasHewan::with('jenisHewan')->orderBy('nama_ras', 'asc')->get();
        $pemiliks = Pemilik::with('user')->get();
        return view('rshp.admin.DataMaster.pet.create', compact('rasHewan', 'pemiliks'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validatePet($request);

        // Helper untuk menyimpan data
        $pet = $this->createPet($validatedData);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Pet berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pet = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])->findOrFail($id);
        $rasHewan = RasHewan::with('jenisHewan')->orderBy('nama_ras', 'asc')->get();
        $pemiliks = Pemilik::with('user')->get();
        
        return view('rshp.admin.DataMaster.pet.edit', compact('pet', 'rasHewan', 'pemiliks'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        // Validasi input
        $validatedData = $this->validatePet($request, $id);

        // Helper untuk update data
        $this->updatePet($pet, $validatedData);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Pet berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        
        // Bisa tambahkan cek relasi jika ada (misal: rekam medis, dll)
        
        $pet->delete();

        return redirect()->route('admin.pet.index')
            ->with('success', 'Pet berhasil dihapus.');
    }

    // ==================== HELPER METHODS ====================

    /**
     * Validasi data pet
     */
    protected function validatePet(Request $request, $id = null)
    {
        return $request->validate([
            'nama_pet' => [
                'required',
                'string',
                'max:255',
                'min:2',
            ],
            'idpemilik' => [
                'required',
                'exists:pemilik,idpemilik'
            ],
            'idras_hewan' => [
                'required',
                'exists:ras_hewan,idras_hewan'
            ],
            'jenis_kelamin' => [
                'required',
                'in:Jantan,Betina'
            ],
            'tanggal_lahir' => [
                'nullable',
                'date',
                'before_or_equal:today'
            ],
            'berat_badan' => [
                'nullable',
                'numeric',
                'min:0.1',
                'max:999.99'
            ],
            'warna' => [
                'nullable',
                'string',
                'max:100'
            ],
            'ciri_khusus' => [
                'nullable',
                'string',
                'max:1000'
            ],
        ], [
            'nama_pet.required' => 'Nama pet wajib diisi.',
            'nama_pet.max' => 'Nama pet maksimal 255 karakter.',
            'nama_pet.min' => 'Nama pet minimal 2 karakter.',
            'idpemilik.required' => 'Pemilik wajib dipilih.',
            'idpemilik.exists' => 'Pemilik tidak valid.',
            'idras_hewan.required' => 'Ras hewan wajib dipilih.',
            'idras_hewan.exists' => 'Ras hewan tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh di masa depan.',
            'berat_badan.numeric' => 'Berat badan harus berupa angka.',
            'berat_badan.min' => 'Berat badan minimal 0.1 kg.',
            'berat_badan.max' => 'Berat badan maksimal 999.99 kg.',
            'warna.max' => 'Warna maksimal 100 karakter.',
            'ciri_khusus.max' => 'Ciri khusus maksimal 1000 karakter.',
        ]);
    }

    /**
     * Helper untuk membuat pet baru
     */
    protected function createPet(array $data)
    {
        return Pet::create([
            'nama_pet' => $this->formatNamaPet($data['nama_pet']),
            'idpemilik' => $data['idpemilik'],
            'idras_hewan' => $data['idras_hewan'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'tanggal_lahir' => $data['tanggal_lahir'] ?? null,
            'berat_badan' => $data['berat_badan'] ?? null,
            'warna' => $data['warna'] ?? null,
            'ciri_khusus' => $data['ciri_khusus'] ?? null,
        ]);
    }

    /**
     * Helper untuk update pet
     */
    protected function updatePet(Pet $pet, array $data)
    {
        $pet->update([
            'nama_pet' => $this->formatNamaPet($data['nama_pet']),
            'idpemilik' => $data['idpemilik'],
            'idras_hewan' => $data['idras_hewan'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'tanggal_lahir' => $data['tanggal_lahir'] ?? null,
            'berat_badan' => $data['berat_badan'] ?? null,
            'warna' => $data['warna'] ?? null,
            'ciri_khusus' => $data['ciri_khusus'] ?? null,
        ]);

        return $pet;
    }

    /**
     * Helper untuk format nama menjadi Title Case
     */
    protected function formatNamaPet($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    /**
     * Helper untuk menghitung umur pet
     */
    protected function hitungUmur($tanggalLahir)
    {
        if (!$tanggalLahir) return null;
        
        $lahir = new \DateTime($tanggalLahir);
        $sekarang = new \DateTime();
        $umur = $lahir->diff($sekarang);
        
        return $umur->y . ' tahun ' . $umur->m . ' bulan';
    }
}