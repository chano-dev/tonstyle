@extends('layouts.app')

@section('title', $service->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Breadcrumb --}}
    <nav class="text-sm mb-6">
        <ol class="flex items-center space-x-2 text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-orange-500">Início</a></li>
            <li>/</li>
            <li><a href="{{ route('services.index') }}" class="hover:text-orange-500">Serviços</a></li>
            <li>/</li>
            <li class="text-gray-900">{{ $service->name }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        {{-- Gallery --}}
        <div>
            @if($service->images->count() > 0)
                <div class="bg-gray-100 rounded-lg overflow-hidden mb-4">
                    <img 
                        id="main-service-image"
                        src="{{ asset('storage/' . $service->images->first()->file_path) }}" 
                        alt="{{ $service->name }}"
                        class="w-full h-96 object-cover"
                    >
                </div>
                
                @if($service->images->count() > 1)
                    <div class="flex gap-2 overflow-x-auto">
                        @foreach($service->images as $image)
                            <button 
                                onclick="document.getElementById('main-service-image').src='{{ asset('storage/' . $image->file_path) }}'"
                                class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 hover:border-orange-500 transition"
                            >
                                <img src="{{ asset('storage/' . $image->file_path) }}" alt="" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="w-full h-96 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-6xl">
                    🛠️
                </div>
            @endif
        </div>

        {{-- Service Info --}}
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $service->name }}</h1>
            
            {{-- Price --}}
            <div class="mb-6">
                <span class="text-3xl font-bold text-orange-500">
                    @if($service->price_type === 'fixed')
                        {{ number_format($service->base_price, 0, ',', '.') }} Kz
                    @elseif($service->price_type === 'per_hour')
                        {{ number_format($service->base_price, 0, ',', '.') }} Kz<span class="text-lg">/hora</span>
                    @elseif($service->price_type === 'per_day')
                        {{ number_format($service->base_price, 0, ',', '.') }} Kz<span class="text-lg">/dia</span>
                    @else
                        A partir de {{ number_format($service->base_price, 0, ',', '.') }} Kz
                    @endif
                </span>
            </div>

            {{-- Short Description --}}
            @if($service->short_description)
                <p class="text-gray-600 mb-6 text-lg">{{ $service->short_description }}</p>
            @endif

            {{-- Details --}}
            <div class="space-y-4 mb-8">
                @if($service->duration_minutes)
                    <div class="flex items-center text-gray-600">
                        <span class="w-8">⏱️</span>
                        <span>Duração: {{ floor($service->duration_minutes / 60) }}h{{ $service->duration_minutes % 60 > 0 ? $service->duration_minutes % 60 . 'min' : '' }}</span>
                    </div>
                @endif
                
                @if($service->requires_booking)
                    <div class="flex items-center text-gray-600">
                        <span class="w-8">📅</span>
                        <span>Requer agendamento prévio</span>
                    </div>
                @endif

                @if($service->requires_deposit)
                    <div class="flex items-center text-gray-600">
                        <span class="w-8">💳</span>
                        <span>Depósito de {{ $service->deposit_percentage }}% para confirmar</span>
                    </div>
                @endif
            </div>

            {{-- CTA Buttons --}}
            <div class="space-y-4">
                <a 
                    href="https://wa.me/244928496036?text=Olá! Tenho interesse no serviço: {{ $service->name }}"
                    target="_blank"
                    class="block w-full bg-green-500 text-white text-center py-4 rounded-lg font-semibold hover:bg-green-600 transition text-lg"
                >
                    💬 Agendar via WhatsApp
                </a>
                
                <a 
                    href="tel:+244928496036"
                    class="block w-full border-2 border-orange-500 text-orange-500 text-center py-3 rounded-lg font-semibold hover:bg-orange-500 hover:text-white transition"
                >
                    📞 Ligar Agora
                </a>
            </div>
        </div>
    </div>

    {{-- Full Description --}}
    @if($service->description)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Sobre o Serviço</h2>
            <div class="prose max-w-none bg-white rounded-lg shadow p-6">
                {!! nl2br(e($service->description)) !!}
            </div>
        </div>
    @endif

    {{-- Related Products --}}
    @if($service->products->count() > 0)
        <section class="mt-16">
            <h2 class="text-2xl font-bold mb-6">Produtos Relacionados</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($service->products->take(4) as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
        </section>
    @endif

    {{-- Other Services --}}
    @if($otherServices->count() > 0)
        <section class="mt-16">
            <h2 class="text-2xl font-bold mb-6">Outros Serviços</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($otherServices as $otherService)
                    <a href="{{ route('services.show', $otherService->slug) }}" class="bg-white rounded-lg shadow p-6 hover:shadow-md transition">
                        <h3 class="font-bold text-lg">{{ $otherService->name }}</h3>
                        <p class="text-gray-600 text-sm mt-2 line-clamp-2">{{ $otherService->short_description }}</p>
                        <p class="text-orange-500 font-bold mt-4">
                            A partir de {{ number_format($otherService->base_price, 0, ',', '.') }} Kz
                        </p>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection