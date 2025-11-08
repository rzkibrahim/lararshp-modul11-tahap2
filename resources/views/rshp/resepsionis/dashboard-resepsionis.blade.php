<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Resepsionis - RSHP</title>
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
                    <span class="font-semibold">{{ session('user_name', 'Resepsionis') }}</span>
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
                <h3 class="text-lg font-bold mb-4 text-gray-700">Menu Resepsionis</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('resepsionis.dashboard') }}"
                            class="block p-2 bg-blue-100 text-blue-700 rounded flex items-center gap-2">
                            <i class="fas fa-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('resepsionis.registrasi.pemilik') }}"
                            class="block p-2 hover:bg-gray-100 rounded flex items-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            Registrasi Pemilik
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('resepsionis.registrasi.pet') }}"
                            class="block p-2 hover:bg-gray-100 rounded flex items-center gap-2">
                            <i class="fas fa-paw"></i>
                            Registrasi Pet
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('resepsionis.temu-dokter') }}"
                            class="block p-2 hover:bg-gray-100 rounded flex items-center gap-2">
                            <i class="fas fa-calendar-check"></i>
                            Temu Dokter & Antrian
                        </a>
                    </li>
                </ul>

                {{-- Quick Stats Sidebar --}}
                <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                    <h4 class="font-semibold text-blue-800 mb-3">Statistik Hari Ini</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Total Antrian:</span>
                            <span class="font-bold text-blue-600">{{ $totalAntrianHariIni ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Menunggu:</span>
                            <span class="font-bold text-orange-600">{{ $antrianMenunggu ?? 0 }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Selesai:</span>
                            <span class="font-bold text-green-600">{{ $antrianSelesai ?? 0 }}</span>
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

                <h2 class="text-3xl font-bold mb-6 text-gray-800">Selamat Datang, {{ session('user_name', 'Resepsionis') }}!</h2>

                {{-- Dashboard Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    {{-- Card 1: Total Antrian Hari Ini --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Total Antrian Hari Ini</h3>
                                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalAntrianHariIni ?? 0 }}</p>
                            </div>
                            <i class="fas fa-list-ol text-blue-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Tanggal: {{ date('d/m/Y') }}</p>
                    </div>

                    {{-- Card 2: Pemilik Aktif --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-green-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Pemilik Aktif</h3>
                                <p class="text-3xl font-bold text-green-600 mt-2">{{ $pemilikAktifHariIni ?? 0 }}</p>
                            </div>
                            <i class="fas fa-users text-green-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Kunjungan hari ini</p>
                    </div>

                    {{-- Card 3: Sedang Diperiksa --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-orange-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Menunggu</h3>
                                <p class="text-3xl font-bold text-orange-600 mt-2">{{ $antrianMenunggu ?? 0 }}</p>
                            </div>
                            <i class="fas fa-clock text-orange-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Dalam antrian</p>
                    </div>

                    {{-- Card 4: Total Pet --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg border-l-4 border-purple-500">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-gray-500 text-sm font-semibold">Total Pet</h3>
                                <p class="text-3xl font-bold text-purple-600 mt-2">{{ $totalPet ?? 0 }}</p>
                            </div>
                            <i class="fas fa-paw text-purple-500 text-2xl"></i>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Terdaftar di sistem</p>
                    </div>
                </div>


                {{-- Quick Actions --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <a href="{{ route('resepsionis.registrasi.pemilik') }}"
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border border-blue-200 hover:border-blue-300">
                        <div class="text-center">
                            <i class="fas fa-user-plus text-blue-500 text-3xl mb-3"></i>
                            <h3 class="font-semibold text-gray-700">Registrasi Pemilik Baru</h3>
                            <p class="text-sm text-gray-500 mt-2">Tambah data pemilik hewan baru</p>
                        </div>
                    </a>

                    <a href="{{ route('resepsionis.registrasi.pet') }}"
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border border-green-200 hover:border-green-300">
                        <div class="text-center">
                            <i class="fas fa-paw text-green-500 text-3xl mb-3"></i>
                            <h3 class="font-semibold text-gray-700">Registrasi Pet Baru</h3>
                            <p class="text-sm text-gray-500 mt-2">Tambah data hewan peliharaan</p>
                        </div>
                    </a>

                    <a href="{{ route('resepsionis.temu-dokter') }}"
                        class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 border border-orange-200 hover:border-orange-300">
                        <div class="text-center">
                            <i class="fas fa-calendar-plus text-orange-500 text-3xl mb-3"></i>
                            <h3 class="font-semibold text-gray-700">Kelola Antrian</h3>
                            <p class="text-sm text-gray-500 mt-2">Kelola temu dokter & antrian</p>
                        </div>
                    </a>
                </div>

                {{-- Antrian Hari Ini --}}
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Antrian Hari Ini</h3>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ date('d F Y') }}
                        </span>
                    </div>

                    @if(count($antrianHariIni ?? []) === 0)
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-calendar-times text-4xl mb-3"></i>
                        <p>Tidak ada antrian hari ini.</p>
                    </div>
                    @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">No. Antrian</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama Pet</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Pemilik</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Waktu Daftar</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($antrianHariIni as $antrian)
                                @php
                                $statusClass = match($antrian->status) {
                                0 => 'bg-yellow-100 text-yellow-800',
                                1 => 'bg-green-100 text-green-800',
                                2 => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800'
                                };

                                $statusText = match($antrian->status) {
                                0 => 'Menunggu',
                                1 => 'Selesai',
                                2 => 'Batal',
                                default => 'Tidak Diketahui'
                                };
                                @endphp
                                <tr>
                                    <td class="px-4 py-3 text-sm font-semibold">{{ $antrian->no_urut }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $antrian->nama_pet }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $antrian->nama_pemilik }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($antrian->waktu_daftar)->format('H:i') }}
                                    </td>
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
                    <h3 class="text-xl font-bold mb-4">Informasi Akun Resepsionis</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">Nama:</p>
                            <p class="font-semibold">{{ session('user_name', 'Resepsionis') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Email:</p>
                            <p class="font-semibold">{{ session('user_email', 'resepsionis@mail.com') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Role:</p>
                            <p class="font-semibold">{{ session('user_role_name', 'Resepsionis') }}</p>
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