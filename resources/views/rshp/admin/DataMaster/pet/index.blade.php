{{-- resources/views/rshp/admin/DataMaster/pet/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pet - RSHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        {{-- Header --}}
        <nav class="bg-blue-600 text-white p-4 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold">Data Pet</h1>
                <a href="{{ route('admin.dashboard') }}" class="bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded transition">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </nav>

        <div class="container mx-auto p-8">
            {{-- Success Message --}}
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Card Container --}}
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-600">
                    <h2 class="text-2xl font-bold text-white">Daftar Pet</h2>
                    <p class="text-blue-100 mt-1">Total: {{ $pets->count() }} pet</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b-2 border-gray-200">
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">No</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">ID Pet</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Nama Pet</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Jenis Kelamin</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Tanggal Lahir</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Jenis Hewan</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Ras Hewan</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Pemilik</th>
                                <th class="p-4 text-center text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($pets as $index => $pet)
                                <tr class="hover:bg-blue-50 transition duration-150">
                                    <td class="p-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                                    <td class="p-4 text-sm text-gray-700">{{ $pet->idpet }}</td>
                                    <td class="p-4">
                                        <div class="font-medium text-gray-900">{{ $pet->nama ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">{{ $pet->warna_tanda ?? '-' }}</div>
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">
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
                                    <td class="p-4 text-sm text-gray-600">
                                        {{ $pet->tanggal_lahir ? \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d M Y') : '-' }}
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">
                                        {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">
                                        {{ $pet->rasHewan->nama_ras ?? '-' }}
                                    </td>
                                    <td class="p-4 text-sm text-gray-600">
                                        {{ $pet->pemilik->user->nama ?? '-' }}
                                    </td>
                                    <td class="p-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="#" class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded transition">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <button class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded transition">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="p-8 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                            <p class="text-lg font-medium">Tidak ada data pet</p>
                                            <p class="text-sm mt-1">Data pet akan muncul di sini</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>