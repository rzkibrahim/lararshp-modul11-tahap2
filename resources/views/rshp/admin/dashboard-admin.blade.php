<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - RSHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        {{-- Header --}}
        <nav class="bg-blue-600 text-white p-4 shadow-lg">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-2xl font-bold">Dashboard Admin</h1>
                <div class="flex items-center gap-4">
                    <span>{{ session('user_name') }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
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
                <h3 class="text-lg font-bold mb-4 text-gray-700">Menu</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block p-2 bg-blue-100 text-blue-700 rounded">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.user.index') }}" class="block p-2 hover:bg-gray-100 rounded">
                            Data User
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pemilik.index') }}" class="block p-2 hover:bg-gray-100 rounded">
                            Data Pemilik
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pet.index') }}" class="block p-2 hover:bg-gray-100 rounded">
                            Data Pet
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.jenis-hewan.index') }}" class="block p-2 hover:bg-gray-100 rounded">
                            Data Jenis Hewan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.ras-hewan.index') }}" class="block p-2 hover:bg-gray-100 rounded">
                            Data Ras Hewan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.role.index') }}" class="block p-2 hover:bg-gray-100 rounded">
                            Data Role
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kategori.index') }}" class="block p-2 hover:bg-gray-100 rounded">
                            Data Kategori
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kategori-klinis.index') }}" class="block p-2 hover:bg-gray-100 rounded">
                            Data Kategori Klinis
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="block p-2 hover:bg-gray-100 rounded">
                            Data Kode Tindakan Terapi
                        </a>
                    </li>
                </ul>
            </aside>

            {{-- Main Content --}}
            <main class="flex-1 p-8">
                {{-- Success Message --}}
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <h2 class="text-3xl font-bold mb-6 text-gray-800">Selamat Datang, {{ session('user_name') }}!</h2>

                {{-- Dashboard Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Card 1 --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-gray-500 text-sm font-semibold">Total User</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-2">150</p>
                    </div>

                    {{-- Card 2 --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-gray-500 text-sm font-semibold">Total Pemilik</h3>
                        <p class="text-3xl font-bold text-green-600 mt-2">320</p>
                    </div>

                    {{-- Card 3 --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-gray-500 text-sm font-semibold">Total Pet</h3>
                        <p class="text-3xl font-bold text-purple-600 mt-2">450</p>
                    </div>

                    {{-- Card 4 --}}
                    <div class="bg-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-gray-500 text-sm font-semibold">Total Transaksi</h3>
                        <p class="text-3xl font-bold text-orange-600 mt-2">89</p>
                    </div>
                </div>

                {{-- Info Section --}}
                <div class="mt-8 bg-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Informasi Akun</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600">Nama:</p>
                            <p class="font-semibold">{{ session('user_name') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Email:</p>
                            <p class="font-semibold">{{ session('user_email') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Role:</p>
                            <p class="font-semibold">{{ session('user_role_name') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Status:</p>
                            <p class="font-semibold text-green-600">{{ session('user_status') }}</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>