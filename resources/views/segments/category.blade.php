@extends('layouts.app')

@section('title', $category->name . ' - ' . $segment->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Breadcrumb --}}
    <nav class="text-sm mb-6">
        <ol class="flex items-center space-x-2 text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-orange-500">Início</a></li>
            <li>/</li>
            <li><a href="{{ route('segments.show', $segment->slug) }}" class="hover:text-orange-500">{{ $segment->name }}</a></li>
            <li>/</li>
            <li class="text-gray-900">{{ $category->name }}</li>
        </ol>
    </nav>

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold">{{ $category->name }}</h1>
        <p class="text-gray-600">em {{ $segment->name }}</p>
    </div>

    {{-- Subcategories --}}
    @if($subcategories->count() > 0)
        <section class="mb-12">
            <h2 class="text-xl font-bold mb-4">Subcategorias</h2>
            <div class="flex flex-wrap gap-3">
                @foreach($subcategories as $subcategory)
                    <a 
                        href="{{ route('segments.subcategory', [$segment->slug, $category->slug, $subcategory->slug]) }}" 
                        class="px-4 py-2 bg-white rounded-full shadow hover:shadow-md hover:bg-orange-50 transition"
                    >
                        {{ $subcategory->name }}
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Products --}}
    @if($products->count() > 0)
        <section>
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600">{{ $products->total() }} produtos</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($products as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </section>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500">Nenhum produto encontrado nesta categoria</p>
        </div>
    @endif
</div>
@endsection