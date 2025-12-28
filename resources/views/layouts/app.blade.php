<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Teu Estilo') - Moda Angolana</title>
    <meta name="description" content="@yield('meta_description', 'Teu Estilo - A melhor loja de moda em Angola. Roupas, calçados, acessórios e muito mais.')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50">
    
    {{-- Header --}}
    @include('components.header')
    
    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>
    
    {{-- Footer --}}
    @include('components.footer')
    
    {{-- Flash Messages --}}
    @if(session('success'))
        <div id="flash-success" class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div id="flash-error" class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif
    
    @stack('scripts')
    
    <script>
        // Auto-hide flash messages
        setTimeout(() => {
            document.getElementById('flash-success')?.remove();
            document.getElementById('flash-error')?.remove();
        }, 5000);
    </script>
</body>
</html>