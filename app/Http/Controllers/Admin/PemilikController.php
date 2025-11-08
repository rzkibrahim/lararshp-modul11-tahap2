<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;  
use Illuminate\Http\Request;

class PemilikController extends Controller
{
    public function index()
    {
        $pemiliks = Pemilik::with('user')
            ->orderBy('idpemilik', 'asc')
            ->get();

        return view('rshp.admin.DataMaster.pemilik.index', compact('pemiliks'));
    }

    public function create()
    {
        // Ambil user yang belum menjadi pemilik
        $users = User::whereDoesntHave('pemilik')->get();
        return view('rshp.admin.DataMaster.pemilik.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $this->validatePemilik($request);

        // Helper untuk menyimpan data
        $pemilik = $this->createPemilik($validatedData);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Pemilik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        
        // Ambil user yang belum menjadi pemilik + user yang sedang diedit
        $users = User::whereDoesntHave('pemilik')
            ->orWhere('iduser', $pemilik->iduser)
            ->get();
            
        return view('rshp.admin.DataMaster.pemilik.edit', compact('pemilik', 'users'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);

        // Validasi input
        $validatedData = $this->validatePemilik($request, $id);

        // Helper untuk update data
        $this->updatePemilik($pemilik, $validatedData);

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Pemilik berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        
        // Cek apakah pemilik masih memiliki pet
        if ($pemilik->pets()->count() > 0) {
            return redirect()->route('admin.pemilik.index')
                ->with('error', 'Pemilik tidak dapat dihapus karena masih memiliki pet.');
        }

        $pemilik->delete();

        return redirect()->route('admin.pemilik.index')
            ->with('success', 'Pemilik berhasil dihapus.');
    }

    // ==================== HELPER METHODS ====================

    /**
     * Validasi data pemilik
     */
    protected function validatePemilik(Request $request, $id = null)
    {
        // Unique rule untuk iduser
        $userUniqueRule = $id ? 
            'unique:pemilik,iduser,' . $id . ',idpemilik' : 
            'unique:pemilik,iduser';

        return $request->validate([
            'iduser' => [
                'required',
                'exists:user,iduser',
                $userUniqueRule
            ],
            'nama_pemilik' => [
                'required',
                'string',
                'max:255',
                'min:3',
            ],
            'no_telepon' => [
                'required',
                'string',
                'max:15',
                'regex:/^[0-9+\-\s()]*$/'
            ],
            'alamat' => [
                'required',
                'string',
                'max:1000',
                'min:10'
            ],
            'email' => [
                'nullable',
                'email',
                'max:255'
            ],
        ], [
            'iduser.required' => 'User wajib dipilih.',
            'iduser.exists' => 'User tidak valid.',
            'iduser.unique' => 'User ini sudah terdaftar sebagai pemilik.',
            'nama_pemilik.required' => 'Nama pemilik wajib diisi.',
            'nama_pemilik.max' => 'Nama pemilik maksimal 255 karakter.',
            'nama_pemilik.min' => 'Nama pemilik minimal 3 karakter.',
            'no_telepon.required' => 'No telepon wajib diisi.',
            'no_telepon.max' => 'No telepon maksimal 15 karakter.',
            'no_telepon.regex' => 'Format no telepon tidak valid.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.max' => 'Alamat maksimal 1000 karakter.',
            'alamat.min' => 'Alamat minimal 10 karakter.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
        ]);
    }

    /**
     * Helper untuk membuat pemilik baru
     */
    protected function createPemilik(array $data)
    {
        return Pemilik::create([
            'iduser' => $data['iduser'],
            'nama_pemilik' => $this->formatNamaPemilik($data['nama_pemilik']),
            'no_telepon' => $data['no_telepon'],
            'alamat' => $data['alamat'],
            'email' => $data['email'] ?? null,
        ]);
    }

    /**
     * Helper untuk update pemilik
     */
    protected function updatePemilik(Pemilik $pemilik, array $data)
    {
        $pemilik->update([
            'iduser' => $data['iduser'],
            'nama_pemilik' => $this->formatNamaPemilik($data['nama_pemilik']),
            'no_telepon' => $data['no_telepon'],
            'alamat' => $data['alamat'],
            'email' => $data['email'] ?? null,
        ]);

        return $pemilik;
    }

    /**
     * Helper untuk format nama menjadi Title Case
     */
    protected function formatNamaPemilik($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    /**
     * Helper untuk format nomor telepon
     */
    protected function formatNoTelepon($nomorTelepon)
    {
        // Hapus spasi, dash, dan karakter khusus lainnya
        $nomor = preg_replace('/[^0-9+]/', '', $nomorTelepon);
        
        // Jika diawali 0, ganti dengan +62
        if (substr($nomor, 0, 1) === '0') {
            $nomor = '+62' . substr($nomor, 1);
        }
        
        return $nomor;
    }
}