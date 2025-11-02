{{-- resources/views/rshp/admin/DataMaster/kategori/index.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori - RSHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        {{-- Header --}}
        <nav class="bg-blue-600 text-white p-4 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold">Data Kategori</h1>
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

            {{-- Error Message --}}
            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    <p class="font-medium">{{ session('error') }}</p>
                </div>
            @endif

            {{-- Card Container --}}
            <div class="bg-white rounded-lg shadow-xl overflow-hidden">
                <div class="p-6 bg-gradient-to-r from-blue-500 to-blue-600 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Daftar Kategori</h2>
                        <p class="text-blue-100 mt-1">Total: {{ $kategori->count() }} kategori</p>
                    </div>
                    <a href="{{ route('admin.kategori.create') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-50 transition">
                        + Tambah Kategori
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 border-b-2 border-gray-200">
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">No</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">ID Kategori</th>
                                <th class="p-4 text-left text-sm font-semibold text-gray-700">Nama Kategori</th>
                                <th class="p-4 text-center text-sm font-semibold text-gray-700">Jumlah Tindakan</th>
                                <th class="p-4 text-center text-sm font-semibold text-gray-700">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($kategori as $index => $item)
                                <tr class="hover:bg-blue-50 transition duration-150">
                                    <td class="p-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                                    <td class="p-4 text-sm text-gray-700">{{ $item->idkategori }}</td>
                                    <td class="p-4">
                                        <div class="font-medium text-gray-900">{{ $item->nama_kategori }}</div>
                                    </td>
                                    <td class="p-4 text-center">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                            {{ $item->kodeTindakanTerapi->count() }} tindakan
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('admin.kategori.edit', $item->idkategori) }}" class="inline-flex items-center px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded transition">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </a>
                                            @if($item->kodeTindakanTerapi->count() == 0)
                                                <form action="{{ route('admin.kategori.destroy', $item->idkategori) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 hover:bg-red-600 text-white text-sm rounded transition">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            @else
                                                <button disabled class="inline-flex items-center px-3 py-1 bg-gray-300 text-gray-500 text-sm rounded cursor-not-allowed" title="Kategori sedang digunakan">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                    </svg>
                                                    Terkunci
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-400">
                                            <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                            <p class="text-lg font-medium">Tidak ada data kategori</p>
                                            <p class="text-sm mt-1">Data kategori akan muncul di sini</p>
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