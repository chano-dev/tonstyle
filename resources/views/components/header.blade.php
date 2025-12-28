{{-- Header do Site --}}
<header class="bg-white shadow-sm sticky top-0 z-40">
    {{-- Top Bar --}}
    <div class="bg-gray-900 text-white text-sm py-2">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <span>📞 +244 928 496 036</span>
            <span>🚚 Entregas em toda Angola</span>
        </div>
    </div>
    
    {{-- Main Header --}}
    <div class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900">
                Teu<span class="text-orange-500">Estilo</span>
            </a>
            
            {{-- Search Bar --}}
            <form action="{{ route('products.search') }}" method="GET" class="hidden md:flex flex-1 max-w-md mx-8">
                <div class="relative w-full">
                    <input 
                        type="text" 
                        name="q" 
                        placeholder="Pesquisar produtos..." 
                        class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                        value="{{ request('q') }}"
                    >
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-orange-500">
                        🔍
                    </button>
                </div>
            </form>
            
            {{-- Actions --}}
            <div class="flex items-center space-x-4">
                {{-- Favoritos --}}
                <a href="#" class="text-gray-600 hover:text-orange-500" title="Favoritos">
                    ❤️
                </a>
                
                {{-- Carrinho --}}
                <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-orange-500" title="Carrinho">
                    🛒
                    <span id="cart-count" class="absolute -top-2 -right-2 bg-orange-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                        0
                    </span>
                </a>
                
                {{-- User --}}
                @auth
                    <a href="{{ route('profile.edit') }}" class="text-gray-600 hover:text-orange-500" title="Minha Conta">
                        👤 {{ Auth::user()->name }}
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-orange-500">
                        Entrar
                    </a>
                @endauth
            </div>
        </div>
    </div>
    
    {{-- Navigation --}}
    <nav class="bg-gray-100 border-t">
        <div class="container mx-auto px-4">
            <ul class="flex items-center space-x-8 py-3 text-sm font-medium">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-orange-500 {{ request()->routeIs('home') ? 'text-orange-500' : '' }}">
                        Início
                    </a>
                </li>
                <li>
                    <a href="{{ route('segments.show', 'mulher') }}" class="text-gray-700 hover:text-orange-500 {{ request()->segment(1) == 'mulher' ? 'text-orange-500' : '' }}">
                        Mulher
                    </a>
                </li>
                <li>
                    <a href="{{ route('segments.show', 'homem') }}" class="text-gray-700 hover:text-orange-500 {{ request()->segment(1) == 'homem' ? 'text-orange-500' : '' }}">
                        Homem
                    </a>
                </li>
                <li>
                    <a href="{{ route('segments.show', 'crianca') }}" class="text-gray-700 hover:text-orange-500 {{ request()->segment(1) == 'crianca' ? 'text-orange-500' : '' }}">
                        Criança
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index', ['on_sale' => 1]) }}" class="text-red-500 hover:text-red-600 font-semibold">
                        🔥 Promoções
                    </a>
                </li>
                <li>
                    <a href="{{ route('services.index') }}" class="text-gray-700 hover:text-orange-500 {{ request()->routeIs('services.*') ? 'text-orange-500' : '' }}">
                        Serviços
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>