<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori Klinis - RSHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-2xl font-bold text-gray-900">Edit Kategori Klinis</h1>
                <nav class="flex space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                    <span class="text-gray-400">/</span>
                    <a href="{{ route('admin.kategori-klinis.index') }}" class="text-blue-600 hover:text-blue-800">Kategori Klinis</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-600">Edit</span>
                </nav>
            </div>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('admin.kategori-klinis.update', $kategoriKlinis->idkategori_klinis) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="nama_kategori_klinis" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Kategori Klinis <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="nama_kategori_klinis" 
                           id="nama_kategori_klinis"
                           value="{{ old('nama_kategori_klinis', $kategoriKlinis->nama_kategori_klinis) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           placeholder="Masukkan nama kategori klinis"
                           required>
                    @error('nama_kategori_klinis')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3">
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-save mr-2"></i>Update
                    </button>
                    <a href="{{ route('admin.kategori-klinis.index') }}" 
                       class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>