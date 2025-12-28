@extends('layouts.app')

@section('title', 'Pesquisa: ' . $query)

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Search Header --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold">Resultados para: "{{ $query }}"</h1>
        <p class="text-gray-500 mt-2">{{ $products->total() }} produtos encontrados</p>
    </div>

    {{-- Results --}}
    @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($products as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg mb-4">Nenhum produto encontrado para "{{ $query }}"</p>
            <p class="text-gray-400">Tenta usar outras palavras-chave</p>
            <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-orange-500 text-white px-6 py-2 rounded-lg hover:bg-orange-600 transition">
                Ver todos os produtos
            </a>
        </div>
    @endif
</div>
@endsection