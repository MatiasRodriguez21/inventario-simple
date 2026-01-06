<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Inventario')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 min-h-screen">
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-boxes text-indigo-600 text-2xl"></i>
                    <h1 class="text-2xl font-bold text-gray-800">Inventario Simple</h1>
                </div>
                <div class="flex items-center space-x-2 text-sm text-gray-600">
                    <i class="fas fa-cube"></i>
                    <span id="total-productos" class="font-semibold">{{ count(session('productos', [])) }}</span>
                    <span>productos</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md animate-slide-in">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <p>{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="mt-12 py-6 text-center text-gray-600 text-sm">
        <p>Sistema de Inventario Simple - Portfolio Demo</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productos = @json(session('productos', []));
            document.getElementById('total-productos').textContent = productos.length;
        });
    </script>
    @yield('scripts')
</body>
</html>

