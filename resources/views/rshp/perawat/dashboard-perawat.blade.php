<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Perawat - RSHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="min-h-screen">
        {{-- Header --}}
        <nav class="bg-purple-600 text-white p-4 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <div class="flex items-center">
                    <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp"
                        alt="Logo Unair" class="h-10 me-3">
                </div>
                <div class="flex items-center gap-4">
                    <span class="font-semibold">{{ session('user_name', 'Perawat') }}</span>
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
                <h3 class="text-lg font-bold mb-4 text-gray-700">Menu Perawat</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('perawat.dashboard') }}"
                            class="block p-2 bg-purple-100 text-purple-700 rounded flex items-center gap-2">
                            <i class="fas fa-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('perawat.rekam-medis') }}"
                            class="block p-2 hover:bg-gray-100 rounded flex items-center gap-2">
                            <i class="fas fa-file-medical"></i>
                            Rekam Medis
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('perawat.pasien-hari-ini') }}"
                            class="block p-2 hover:bg-gray-100 rounded flex items-center gap-2">
                            <i class="fas fa-user-injured"></i>
                            Pasien Hari Ini
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('perawat.tindakan') }}"
                            class="block p-2 hover:bg-gray-100 rounded flex items-center gap-2">
                            <i class="fas fa-procedures"></i>
                            Tindakan Perawat
                        </a>
                    </li>
                </ul>

                {{-- Quick Stats Sidebar --}}
                <div class="mt-8 p-4 bg-purple-50 rounded-lg">
                    <h4 class="font-semibold text-purple-800 mb-3">Statistik Hari Ini</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Pasien Dirawat:</span>
                            <span class="font-bold text-purple-600">{{ $pasienDirawat ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tindakan:</span>
                            <span class="font-bold text-blue-600">{{ $totalTindakan ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Menunggu:</span>
                            <span class="font-bold text-orange-600">{{ $pasienMenunggu ?? 0 }}</span>
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

                <h2 class="text-3xl font-bold mb-6 text-gray-800">Selamat Datang, {{ session('user_name', 'Perawat') }}!</h2>

                {{-- Dashboard Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    {{-- Card 1: Pasien Hari Ini --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Pasien Hari Ini</h3>
                                <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalPasienHariIni ?? 0 }}</p>
                            </div>
                            <i class="fas fa-user-injured text-purple-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Tanggal: {{ date('d/m/Y') }}</p>
                    </div>

                    {{-- Card 2: Tindakan Hari Ini --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Tindakan Hari Ini</h3>
                                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $tindakanHariIni ?? 0 }}</p>
                            </div>
                            <i class="fas fa-syringe text-blue-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Tindakan dilakukan</p>
                    </div>

                    {{-- Card 3: Menunggu Perawatan --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-orange-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Menunggu Perawatan</h3>
                                <p class="text-3xl font-bold text-orange-600 mt-2">{{ $menungguPerawatan ?? 0 }}</p>
                            </div>
                            <i class="fas fa-clock text-orange-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Dalam antrian</p>
                    </div>

                    {{-- Card 4: Total Perawatan --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Total Perawatan</h3>
                                <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalPerawatan ?? 0 }}</p>
                            </div>
                            <i class="fas fa-hand-holding-medical text-green-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Semua waktu</p>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <a href="{{ route('perawat.rekam-medis') }}"
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border border-purple-200 hover:border-purple-300">
                        <div class="text-center">
                            <i class="fas fa-file-medical text-purple-500 text-3xl mb-3"></i>
                            <h3 class="font-semibold text-gray-700">Rekam Medis</h3>
                            <p class="text-sm text-gray-500 mt-2">Kelola rekam medis pasien</p>
                        </div>
                    </a>

                    <a href="{{ route('perawat.pasien-hari-ini') }}"
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border border-blue-200 hover:border-blue-300">
                        <div class="text-center">
                            <i class="fas fa-list text-blue-500 text-3xl mb-3"></i>
                            <h3 class="font-semibold text-gray-700">Pasien Hari Ini</h3>
                            <p class="text-sm text-gray-500 mt-2">Lihat daftar pasien</p>
                        </div>
                    </a>

                    <a href="{{ route('perawat.tindakan') }}"
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border border-orange-200 hover:border-orange-300">
                        <div class="text-center">
                            <i class="fas fa-procedures text-orange-500 text-3xl mb-3"></i>
                            <h3 class="font-semibold text-gray-700">Tindakan</h3>
                            <p class="text-sm text-gray-500 mt-2">Input tindakan perawat</p>
                        </div>
                    </a>
                </div>

                {{-- Pasien Hari Ini --}}
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Pasien Hari Ini</h3>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ date('d F Y') }}
                        </span>
                    </div>

                    @if(count($pasienHariIni ?? []) === 0)
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-user-times text-4xl mb-3"></i>
                        <p>Tidak ada pasien hari ini.</p>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No. Antrian</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama Pet</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Pemilik</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Jenis Hewan</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($pasienHariIni as $pasien)
                                @php
                                $statusClass = match($pasien->status) {
                                0 => 'bg-yellow-100 text-yellow-800',
                                1 => 'bg-green-100 text-green-800',
                                2 => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800'
                                };

                                $statusText = match($pasien->status) {
                                0 => 'Menunggu',
                                1 => 'Selesai',
                                2 => 'Batal',
                                default => 'Tidak Diketahui'
                                };
                                @endphp
                                <tr>
                                    <td class="px-4 py-3 text-sm font-semibold">{{ $pasien->no_urut }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $pasien->nama_pet }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $pasien->nama_pemilik }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $pasien->jenis_hewan }}</td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $statusClass }}">
                                            {{ $statusText }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($pasien->status == 0)
                                        <a href="{{ route('perawat.tindakan.create', $pasien->id) }}" 
                                           class="bg-purple-500 hover:bg-purple-600 text-white px-3 py-1 rounded text-sm">
                                            Rawat
                                        </a>
                                        @elseif($pasien->status == 1)
                                        <span class="text-green-600 text-sm">Selesai</span>
                                        @else
                                        <span class="text-red-600 text-sm">Dibatalkan</span>
                                        @endif
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
                    <h3 class="text-xl font-bold mb-4">Informasi Akun Perawat</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">Nama:</p>
                            <p class="font-semibold">{{ session('user_name', 'Perawat') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Email:</p>
                            <p class="font-semibold">{{ session('user_email', 'perawat@mail.com') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Role:</p>
                            <p class="font-semibold">{{ session('user_role_name', 'Perawat') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Shift:</p>
                            <p class="font-semibold text-green-600">Pagi (08:00 - 16:00)</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>