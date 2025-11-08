<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - RSHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-2xl font-bold text-gray-900">Tambah User</h1>
                <nav class="flex space-x-4 items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-home mr-1"></i> Dashboard
                    </a>
                    <span class="text-gray-400">/</span>
                    <a href="{{ route('admin.user.index') }}" class="text-blue-600 hover:text-blue-800">
                        User
                    </a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-600">Tambah</span>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Success/Error Messages -->
        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form Container -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-blue-700 to-blue-600 px-6 py-4">
                <h2 class="text-xl font-semibold text-white">Form Tambah User</h2>
            </div>

            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Nama *</label>
                    <input type="text" name="nama"
                        value="{{ old('nama') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-400 @error('nama') border-red-500 @enderror"
                        placeholder="Masukkan nama lengkap" required>
                    @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email *</label>
                    <input type="email" name="email"
                        value="{{ old('email') }}"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-400 @error('email') border-red-500 @enderror"
                        placeholder="Masukkan email" required>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Password *</label>
                    <input type="password" name="password"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-400"
                        placeholder="Minimal 3 karakter" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">Konfirmasi Password *</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-blue-400"
                        required>
                </div>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
                    Simpan
                </button>
            </form>

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
</body>

</html>