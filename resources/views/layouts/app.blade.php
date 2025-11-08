<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Poppins:400,500,600,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Laravel Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        /* 🌅 Background gradasi lembut - SAMA UNTUK SEMUA HALAMAN */
        body {
            background: linear-gradient(135deg, #FEEBC8, #F6AD55);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        /* 🌟 Navbar Styling - SAMA UNTUK SEMUA HALAMAN */
        nav.navbar {
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        nav.navbar:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.12);
        }

        .navbar-brand {
            font-weight: 600;
            color: #DD6B20 !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .navbar-brand i {
            color: #F6AD55;
        }

        .nav-link {
            color: #4A5568 !important;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #DD6B20 !important;
        }

        /* 🔹 Konten utama - SAMA UNTUK SEMUA HALAMAN */
        main {
            padding: 2rem 1rem;
        }

        /* 🔸 Card umum (untuk login, form, dsb.) - SAMA UNTUK SEMUA HALAMAN */
        .card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.15);
        }

        /* 🔘 Tombol umum - SAMA UNTUK SEMUA HALAMAN */
        .btn-primary {
            background-color: #F6AD55 !important;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #DD6B20 !important;
            transform: scale(1.05);
        }

        /* 🔙 Tombol kembali - SAMA UNTUK SEMUA HALAMAN */
        .btn-secondary {
            background-color: #E2E8F0 !important;
            color: #2D3748 !important;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #CBD5E0 !important;
            transform: scale(1.05);
        }

        /* ✉️ Input form - SAMA UNTUK SEMUA HALAMAN */
        input[type="text"], input[type="email"], input[type="password"] {
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        input:focus {
            border-color: #F6AD55 !important;
            box-shadow: 0 0 0 3px rgba(246, 173, 85, 0.3) !important;
        }

        /* 📱 Responsif - SAMA UNTUK SEMUA HALAMAN */
        @media (max-width: 768px) {
            main {
                padding: 1rem;
            }
        }

        /* STYLING KHUSUS UNTUK HALAMAN LOGIN */
        .login-container {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 2rem;
        }

        .login-container:hover {
            transform: translateY(-3px);
            box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.15);
        }

        .login-title {
            color: #DD6B20;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .login-button {
            background-color: #F6AD55 !important;
            border: none;
            transition: all 0.3s ease;
            width: 100%;
            padding: 0.75rem;
            border-radius: 8px;
            color: white;
            font-weight: 500;
        }

        .login-button:hover {
            background-color: #DD6B20 !important;
            transform: scale(1.02);
        }

        /* STYLING KHUSUS UNTUK HALAMAN HOME */
        .home-section {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .home-section:hover {
            transform: translateY(-3px);
            box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.15);
        }

        .section-title {
            color: #DD6B20;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border-bottom: 3px solid #F6AD55;
            padding-bottom: 0.5rem;
        }

        .news-card {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fa-solid fa-paw"></i> {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right Side -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fa-solid fa-right-to-bracket mr-1"></i> {{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fa-solid fa-user-plus mr-1"></i> {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   <i class="fa-solid fa-user-circle mr-1"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket mr-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>