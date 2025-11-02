<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kode Tindakan & Terapi - RSHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-2xl font-bold text-gray-900">Tambah Kode Tindakan & Terapi</h1>
                <nav class="flex space-x-4">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">Dashboard</a>
                    <span class="text-gray-400">/</span>
                    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="text-blue-600 hover:text-blue-800">Kode Tindakan & Terapi</a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-600">Tambah</span>
                </nav>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <form action="{{ route('admin.kode-tindakan-terapi.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Kode -->
                    <div>
                        <label for="kode" class="block text-sm font-medium text-gray-700 mb-2">
                            Kode <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               name="kode" 
                               id="kode"
                               value="{{ old('kode') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Masukkan kode (max 5 karakter)"
                               maxlength="5"
                               required>
                        @error('kode')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="idkategori" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="idkategori" 
                                id="idkategori"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->idkategori }}" {{ old('idkategori') == $kat->idkategori ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('idkategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori Klinis -->
                    <div>
                        <label for="idkategori_klinis" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori Klinis <span class="text-red-500">*</span>
                        </label>
                        <select name="idkategori_klinis" 
                                id="idkategori_klinis"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                            <option value="">Pilih Kategori Klinis</option>
                            @foreach($kategoriKlinis as $kk)
                                <option value="{{ $kk->idkategori_klinis }}" {{ old('idkategori_klinis') == $kk->idkategori_klinis ? 'selected' : '' }}>
                                    {{ $kk->nama_kategori_klinis }}
                                </option>
                            @endforeach
                        </select>
                        @error('idkategori_klinis')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mt-6">
                    <label for="deskripsi_tindakan_terapi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi Tindakan/Terapi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="deskripsi_tindakan_terapi" 
                              id="deskripsi_tindakan_terapi"
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              placeholder="Masukkan deskripsi tindakan atau terapi"
                              required>{{ old('deskripsi_tindakan_terapi') }}</textarea>
                    @error('deskripsi_tindakan_terapi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 mt-6">
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-save mr-2"></i>Simpan
                    </button>
                    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" 
                       class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>