{{-- resources/views/rshp/admin/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - RSHP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .btn-primary {
            @apply bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200;
        }
        .btn-secondary {
            @apply bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200;
        }
        .btn-success {
            @apply bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200;
        }
        .btn-warning {
            @apply bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition duration-200;
        }
        .btn-danger {
            @apply bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-200;
        }
        .card {
            @apply bg-white rounded-xl shadow-lg overflow-hidden;
        }
        .card-header {
            @apply bg-gradient-to-r from-blue-700 to-blue-600 px-6 py-4;
        }
        .badge-primary {
            @apply inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800;
        }
        .badge-success {
            @apply inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800;
        }
        .badge-warning {
            @apply inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800;
        }
        .badge-danger {
            @apply inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800;
        }
        .badge-gray {
            @apply inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <h1 class="text-2xl font-bold text-gray-900">@yield('title')</h1>
                <nav class="flex space-x-4 items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-home mr-1"></i> Dashboard
                    </a>
                    <span class="text-gray-400">/</span>
                    <span class="text-gray-600">@yield('title')</span>
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

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <p class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Rumah Sakit Harapan Paksi. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Script untuk alert -->
    <script>
        // Auto-hide success/error messages setelah 5 detik
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