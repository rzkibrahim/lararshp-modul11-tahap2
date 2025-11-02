{{-- resources/views/rshp/admin/DataMaster/ras-hewan/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Ras Hewan - RSHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        {{-- Header --}}
        <nav class="bg-blue-600 text-white p-4 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold">Data Ras Hewan</h1>
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
                <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-600 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Daftar Ras Hewan</h2>
                        <p class="text-blue-100 mt-1">Total: {{ $rasHewan->count() }} ras hewan</p>
                    </div>
                    <a href="{{ route('admin.ras-hewan.create') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-50 transition">
                        + Tambah Ras Hewan
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b-2 border-gray-200">
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">No</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">ID Ras</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Nama Ras</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Jenis Hewan</th>
                                <th class="p-4 text-center text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($rasHewan as $index => $item)
                                <tr class="hover:bg-blue-50 transition duration-150">
                                    <td class="p-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                                    <td class="p-4 text-sm text-gray-700">{{ $item->idras_hewan }}</td>
                                    <td class="p-4">
                                        <div class="font-medium text-gray-900">{{ $item->nama_ras }}</div>
                                    </td>
                                    <td class="p-4">
                                        @if($item->jenisHewan)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                {{ $item->jenisHewan->nama_jenis_hewan }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('admin.ras-hewan.edit', $item->idras_hewan) }}" class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded transition">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.ras-hewan.destroy', $item->idras_hewan) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus ras hewan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded transition">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                            <p class="text-lg font-medium">Tidak ada data ras hewan</p>
                                            <p class="text-sm mt-1">Data ras hewan akan muncul di sini</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination jika diperlukan --}}
                @if($rasHewan->count() > 0)
                    <div class="p-4 bg-gray-50 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Menampilkan <span class="font-medium">{{ $rasHewan->count() }}</span> data
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>