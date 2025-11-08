@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - RSHP Universitas Airlangga</title>

    {{-- Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'rshp': {
                            'primary': '#0077b6',
                            'secondary': '#00b4d8',
                            'dark': '#03045e',
                            'light': '#90e0ef',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50 text-gray-700 min-h-screen antialiased font-sans">

    {{-- MAIN CONTENT - LOGIN FORM --}}
    <main class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            {{-- Login Card --}}
            <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-blue-700 mb-2">Login Akun</h2>
                    <p class="text-gray-600">Masuk ke sistem RSHP Universitas Airlangga</p>
                </div>

                {{-- Error Messages --}}
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                {{-- Login Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    {{-- Email Input --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Alamat Email
                        </label>
                        <input id="email" 
                               type="email"
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email" 
                               autofocus
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('email') border-red-500 @enderror">
                        
                        @error('email')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Input --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kata Sandi
                        </label>
                        <input id="password" 
                               type="password"
                               name="password" 
                               required 
                               autocomplete="current-password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('password') border-red-500 @enderror">
                        
                        @error('password')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me Checkbox --}}
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember"
                               {{ old('remember') ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="remember" class="ml-2 text-sm text-gray-700">
                            Ingat Saya
                        </label>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold py-3 px-4 rounded-lg hover:from-blue-700 hover:to-blue-800 focus:ring-4 focus:ring-blue-300 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Masuk
                    </button>

                    {{-- Forgot Password Link --}}
                    @if (Route::has('password.request'))
                        <div class="text-center mt-4">
                            <a href="{{ route('password.request') }}" 
                               class="text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                                Lupa Password?
                            </a>
                        </div>
                    @endif
                </form>

                {{-- Divider --}}
                <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                    <p class="text-sm text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                            Hubungi Administrator
                        </a>
                    </p>
                </div>
            </div>

            {{-- Info Card --}}
            <div class="mt-6 bg-blue-50 p-6 rounded-xl border border-blue-200">
                <div class="flex items-start gap-3">
                    <div class="text-blue-600 text-2xl">ℹ️</div>
                    <div>
                        <h3 class="font-bold text-blue-700 mb-2">Informasi Login</h3>
                        <p class="text-sm text-gray-700 leading-relaxed">
                            Gunakan email dan password yang telah terdaftar di sistem. 
                            Untuk bantuan, silakan hubungi administrator RSHP.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- FOOTER --}}
    <footer class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-900 text-white text-center py-8 mt-12 shadow-2xl">
        <div class="max-w-7xl mx-auto px-4">
            <p class="text-base font-medium">&copy; {{ date('Y') }} RSHP - Rumah Sakit Hewan Pendidikan Universitas Airlangga</p>
            <p class="text-sm mt-2 text-blue-200">Sistem Informasi Manajemen Rumah Sakit Hewan</p>
        </div>
    </footer>

</body>

</html>
@endsection