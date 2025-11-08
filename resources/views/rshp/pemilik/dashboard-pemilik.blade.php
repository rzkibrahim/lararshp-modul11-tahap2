<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemilik - RSHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        {{-- Header --}}
        <nav class="bg-blue-600 text-white p-4 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <div class="flex items-center">
                    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp"
                        alt="Logo Unair" class="h-10 me-3">
                </div>
                <div class="flex items-center gap-4">
                    <span class="font-semibold">{{ session('user_name', 'Pemilik') }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded flex items-center gap-2">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        {{-- Sidebar & Content --}}
        <div class="flex">
            {{-- Sidebar --}}
            <aside class="w-64 bg-white h-screen shadow-lg p-4">
                <h3 class="text-lg font-bold mb-4 text-gray-700">Menu Pemilik</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('pemilik.dashboard') }}"
                            class="block p-2 bg-blue-100 text-blue-700 rounded flex items-center gap-2">
                            <i class="fas fa-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pemilik.pet.list') }}"
                            class="block p-2 hover:bg-gray-100 rounded flex items-center gap-2">
                            <i class="fas fa-paw"></i>
                            Data Pet
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pemilik.reservasi.list') }}"
                            class="block p-2 hover:bg-gray-100 rounded flex items-center gap-2">
                            <i class="fas fa-calendar-plus"></i>
                            Buat Reservasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pemilik.rekammedis.list') }}"
                            class="block p-2 hover:bg-gray-100 rounded flex items-center gap-2">
                            <i class="fas fa-file-medical"></i>
                            Rekam Medis
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pemilik.riwayat.list') }}"
                            class="block p-2 hover:bg-gray-100 rounded flex items-center gap-2">
                            <i class="fas fa-history"></i>
                            Riwayat Kunjungan
                        </a>
                    </li>
                </ul>

                {{-- Quick Stats Sidebar --}}
                <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-semibold text-blue-800 mb-3">Statistik Saya</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Pet:</span>
                            <span class="font-bold text-blue-600">{{ $totalPet ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Kunjungan:</span>
                            <span class="font-bold text-green-600">{{ $totalKunjungan ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Menunggu:</span>
                            <span class="font-bold text-orange-600">{{ $menungguAntrian ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- Main Content --}}
            <main class="flex-1 p-8">
                {{-- Success Message --}}
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
                @endif

                <h2 class="text-3xl font-bold mb-6 text-gray-800">Selamat Datang, {{ session('user_name', 'Pemilik') }}!</h2>

                {{-- Dashboard Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    {{-- Card 1: Total Pet --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Total Pet</h3>
                                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalPet ?? 0 }}</p>
                            </div>
                            <i class="fas fa-paw text-blue-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Hewan peliharaan aktif</p>
                    </div>

                    {{-- Card 2: Total Kunjungan --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Total Kunjungan</h3>
                                <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalKunjungan ?? 0 }}</p>
                            </div>
                            <i class="fas fa-calendar-check text-green-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Semua waktu</p>
                    </div>

                    {{-- Card 3: Kunjungan Bulan Ini --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-orange-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Kunjungan Bulan Ini</h3>
                                <p class="text-3xl font-bold text-orange-600 mt-2">{{ $kunjunganBulanIni ?? 0 }}</p>
                            </div>
                            <i class="fas fa-calendar-alt text-orange-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Bulan {{ date('F Y') }}</p>
                    </div>

                    {{-- Card 4: Menunggu Antrian --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Menunggu Antrian</h3>
                                <p class="text-3xl font-bold text-purple-600 mt-2">{{ $menungguAntrian ?? 0 }}</p>
                            </div>
                            <i class="fas fa-clock text-purple-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Reservasi aktif</p>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <a href="{{ route('pemilik.pet.list') }}"
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border border-blue-200 hover:border-blue-300">
                        <div class="text-center">
                            <i class="fas fa-paw text-blue-500 text-3xl mb-3"></i>
                            <h3 class="font-semibold text-gray-700">Data Pet</h3>
                            <p class="text-sm text-gray-500 mt-2">Kelola hewan peliharaan</p>
                        </div>
                    </a>

                    <a href="{{ route('pemilik.reservasi.list') }}"
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border border-green-200 hover:border-green-300">
                        <div class="text-center">
                            <i class="fas fa-calendar-plus text-green-500 text-3xl mb-3"></i>
                            <h3 class="font-semibold text-gray-700">Buat Reservasi</h3>
                            <p class="text-sm text-gray-500 mt-2">Jadwalkan kunjungan</p>
                        </div>
                    </a>

                    <a href="{{ route('pemilik.rekammedis.list') }}"
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border border-orange-200 hover:border-orange-300">
                        <div class="text-center">
                            <i class="fas fa-file-medical text-orange-500 text-3xl mb-3"></i>
                            <h3 class="font-semibold text-gray-700">Rekam Medis</h3>
                            <p class="text-sm text-gray-500 mt-2">Lihat riwayat kesehatan</p>
                        </div>
                    </a>
                </div>

                {{-- Pet Saya --}}
                <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Pet Saya</h3>
                        <a href="{{ route('pemilik.pet.list') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Lihat Semua →
                        </a>
                    </div>

                    @if(count($listPet ?? []) === 0)
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-paw text-4xl mb-3"></i>
                        <p>Belum ada pet terdaftar.</p>
                        <a href="{{ route('pemilik.reservasi.list') }}" class="text-blue-600 hover:text-blue-800 mt-2 inline-block">
                            Daftarkan pet pertama Anda →
                        </a>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama Pet</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jenis</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Ras</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jenis Kelamin</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($listPet->take(5) as $pet)
                                <tr>
                                    <td class="px-4 py-3 text-sm font-semibold">{{ $pet->nama }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $pet->nama_jenis_hewan ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $pet->nama_ras ?? '-' }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        @if($pet->jenis_kelamin == 'M')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Jantan</span>
                                        @elseif($pet->jenis_kelamin == 'F')
                                            <span class="px-2 py-1 bg-pink-100 text-pink-800 rounded-full text-xs">Betina</span>
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('pemilik.reservasi') }}?pet={{ $pet->idpet }}" 
                                           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                            Reservasi
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

                {{-- Riwayat Kunjungan Terbaru --}}
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Riwayat Kunjungan Terbaru</h3>
                        <a href="{{ route('pemilik.riwayat.list') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            Lihat Semua →
                        </a>
                    </div>

                    @if(count($riwayatKunjungan ?? []) === 0)
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-history text-4xl mb-3"></i>
                        <p>Belum ada riwayat kunjungan.</p>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Tanggal</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama Pet</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Dokter</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($riwayatKunjungan as $riwayat)
                                @php
                                $statusClass = match($riwayat->status) {
                                0 => 'bg-yellow-100 text-yellow-800',
                                1 => 'bg-green-100 text-green-800',
                                2 => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800'
                                };

                                $statusText = match($riwayat->status) {
                                0 => 'Menunggu',
                                1 => 'Selesai',
                                2 => 'Batal',
                                default => 'Tidak Diketahui'
                                };
                                @endphp
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($riwayat->waktu_daftar)->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-4 py-3 text-sm font-semibold">{{ $riwayat->nama_pet }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $riwayat->nama_dokter ?? '-' }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                            {{ $statusText }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

                {{-- Info Section --}}
                <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Informasi Akun Pemilik</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">Nama:</p>
                            <p class="font-semibold">{{ session('user_name', 'Pemilik') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Email:</p>
                            <p class="font-semibold">{{ session('user_email', 'pemilik@mail.com') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Role:</p>
                            <p class="font-semibold">{{ session('user_role_name', 'Pemilik') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Member Since:</p>
                            <p class="font-semibold text-green-600">{{ date('F Y') }}</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>