<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet - RSHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-2xl font-bold text-gray-900">Pet</h1>
                <nav class="flex space-x-4 items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-home mr-1"></i> Dashboard
                    </a>
                    <span class="text-gray-400">/</span>
                    
                    <!-- Dropdown Data Master -->
                    <div class="relative group">
                        <button class="text-blue-600 hover:text-blue-800 flex items-center">
                            <i class="fas fa-database mr-1"></i> Data Master
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-10 border border-gray-200">
                            <div class="py-2">
                                <a href="{{ route('admin.jenis-hewan.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-paw mr-2"></i>Jenis Hewan
                                </a>
                                <a href="{{ route('admin.kategori.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-tags mr-2"></i>Kategori
                                </a>
                                <a href="{{ route('admin.kategori-klinis.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-stethoscope mr-2"></i>Kategori Klinis
                                </a>
                                <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-procedures mr-2"></i>Kode Tindakan & Terapi
                                </a>
                                <a href="{{ route('admin.pemilik.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-users mr-2"></i>Pemilik
                                </a>
                                <a href="{{ route('admin.pet.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 bg-blue-50 text-blue-600">
                                    <i class="fas fa-dog mr-2"></i>Pet
                                </a>
                                <a href="{{ route('admin.ras-hewan.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-dna mr-2"></i>Ras Hewan
                                </a>
                                <a href="{{ route('admin.role.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-user-tag mr-2"></i>Role
                                </a>
                                <a href="{{ route('admin.user.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600">
                                    <i class="fas fa-user mr-2"></i>User
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-600">Pet</span>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-700 to-blue-600 px-6 py-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-white">Data Pet</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-blue-100">Total: {{ $pets->count() }} pet</span>
                        <a href="{{ route('admin.pet.create') }}" 
                           class="bg-white text-blue-700 px-4 py-2 rounded-lg hover:bg-blue-50 transition duration-200">
                            <i class="fas fa-plus mr-2"></i>Tambah Data
                        </a>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="p-4 text-left font-semibold text-gray-700">No</th>
                            <th class="p-4 text-left font-semibold text-gray-700">ID Pet</th>
                            <th class="p-4 text-left font-semibold text-gray-700">Nama Pet</th>
                            <th class="p-4 text-left font-semibold text-gray-700">Jenis Kelamin</th>
                            <th class="p-4 text-left font-semibold text-gray-700">Tanggal Lahir</th>
                            <th class="p-4 text-left font-semibold text-gray-700">Jenis Hewan</th>
                            <th class="p-4 text-left font-semibold text-gray-700">Ras Hewan</th>
                            <th class="p-4 text-left font-semibold text-gray-700">Pemilik</th>
                            <th class="p-4 text-left font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pets as $index => $pet)
                        <tr class="border-b border-gray-200 hover:bg-blue-50 transition duration-150">
                            <td class="p-4 text-gray-600">{{ $index + 1 }}</td>
                            <td class="p-4 text-gray-800 font-medium">{{ $pet->idpet }}</td>
                            <td class="p-4 text-gray-800">
                                <div class="font-medium">{{ $pet->nama ?? '-' }}</div>
                                <div class="text-sm text-gray-500">{{ $pet->warna_tanda ?? '-' }}</div>
                            </td>
                            <td class="p-4">
                                @if($pet->jenis_kelamin == 'M')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    ♂ Jantan
                                </span>
                                @elseif($pet->jenis_kelamin == 'F')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                    ♀ Betina
                                </span>
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="p-4 text-gray-800">
                                {{ $pet->tanggal_lahir ? \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d M Y') : '-' }}
                            </td>
                            <td class="p-4 text-gray-800">
                                {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}
                            </td>
                            <td class="p-4 text-gray-800">
                                {{ $pet->rasHewan->nama_ras ?? '-' }}
                            </td>
                            <td class="p-4 text-gray-800">
                                {{ $pet->pemilik->user->nama ?? '-' }}
                            </td>
                            <td class="p-4">
                                <div class="flex gap-2">
                                    <a href="#" 
                                       class="px-3 py-1 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                                        <i class="fas fa-edit mr-1"></i>Edit
                                    </a>
                                    <form action="#" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pet ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700 transition duration-200">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="p-8 text-center text-gray-500">
                                <i class="fas fa-dog text-4xl mb-4 text-gray-300"></i>
                                <p class="text-lg">Tidak ada data pet</p>
                                <a href="{{ route('admin.pet.create') }}" 
                                   class="inline-block mt-2 text-blue-600 hover:text-blue-800">
                                    Tambah data pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Rumah Sakit Hewan Pendidikan. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Script untuk alert -->
    <script>
        setTimeout(() => {
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>