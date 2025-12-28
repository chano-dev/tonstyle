@extends('layouts.app')

@section('title', $segment->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Header --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold">{{ $segment->name }}</h1>
        @if($segment->description)
            <p class="text-gray-600 mt-2">{{ $segment->description }}</p>
        @endif
    </div>

    {{-- Categories --}}
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-6">Categorias</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('segments.category', [$segment->slug, $category->slug]) }}" class="bg-white rounded-lg shadow p-6 text-center hover:shadow-md transition">
                    <span class="text-3xl">{{ $category->icon ?? '📦' }}</span>
                    <h3 class="mt-2 font-medium">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $category->subcategories->count() }} subcategorias</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Featured Products --}}
    @if($featuredProducts->count() > 0)
        <section class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Em Destaque</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
        </section>
    @endif

    {{-- New Products --}}
    @if($newProducts->count() > 0)
        <section>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Novidades</h2>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($newProducts as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection