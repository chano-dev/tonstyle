@extends('layouts.app')

@section('title', 'Início')

@section('content')
    {{-- Hero Banner --}}
    <section class="bg-gradient-to-r from-orange-500 to-pink-500 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Teu Estilo, Tua Essência</h1>
            <p class="text-xl mb-8">Descobre as últimas tendências da moda em Angola</p>
            <a href="{{ route('segments.show', 'mulher') }}" class="bg-white text-orange-500 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                Explorar Agora
            </a>
        </div>
    </section>

    {{-- Categorias --}}
    <section class="py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-bold text-center mb-8">Categorias</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                @foreach($categories as $category)
                    <a href="{{ route('segments.category', ['segment' => 'mulher', 'category' => $category->slug]) }}" class="bg-white rounded-lg shadow p-6 text-center hover:shadow-md transition">
                        <span class="text-3xl">{{ $category->icon ?? '👗' }}</span>
                        <h3 class="mt-2 font-medium">{{ $category->name }}</h3>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Produtos em Destaque --}}
    @if($featuredProducts->count() > 0)
        <section class="py-12 bg-gray-100">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold">Em Destaque</h2>
                    <a href="{{ route('products.index') }}" class="text-orange-500 hover:underline">Ver todos →</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Novidades --}}
    @if($newProducts->count() > 0)
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold">🆕 Novidades</h2>
                    <a href="{{ route('products.index', ['new' => 1]) }}" class="text-orange-500 hover:underline">Ver todos →</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($newProducts as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Banner Promoções --}}
    @if($saleProducts->count() > 0)
        <section class="py-12 bg-red-500 text-white">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold">🔥 Promoções</h2>
                    <a href="{{ route('products.index', ['on_sale' => 1]) }}" class="text-white hover:underline">Ver todos →</a>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach($saleProducts as $product)
                        @include('components.product-card', ['product' => $product])
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Serviços --}}
    @if($services->count() > 0)
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold">Nossos Serviços</h2>
                    <a href="{{ route('services.index') }}" class="text-orange-500 hover:underline">Ver todos →</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    @foreach($services as $service)
                        <a href="{{ route('services.show', $service->slug) }}" class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
                            <h3 class="font-semibold text-lg">{{ $service->name }}</h3>
                            <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ $service->short_description }}</p>
                            <p class="text-orange-500 font-bold mt-4">
                                @if($service->price_type === 'fixed')
                                    {{ number_format($service->base_price, 0, ',', '.') }} Kz
                                @else
                                    A partir de {{ number_format($service->base_price, 0, ',', '.') }} Kz
                                @endif
                            </p>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Newsletter --}}
    <section class="py-12 bg-gray-900 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">Recebe as Novidades</h2>
            <p class="text-gray-400 mb-6">Subscreve e fica a par das últimas tendências e promoções</p>
            <form class="max-w-md mx-auto flex gap-2">
                <input type="email" placeholder="O teu email" class="flex-1 px-4 py-3 rounded-lg text-gray-900">
                <button type="submit" class="bg-orange-500 px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition">
                    Subscrever
                </button>
            </form>
        </div>
    </section>
@endsection