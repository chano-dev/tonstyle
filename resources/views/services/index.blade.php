@extends('layouts.app')

@section('title', $subcategory->name . ' - ' . $segment->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Breadcrumb --}}
    <nav class="text-sm mb-6">
        <ol class="flex items-center space-x-2 text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-orange-500">Início</a></li>
            <li>/</li>
            <li><a href="{{ route('segments.show', $segment->slug) }}" class="hover:text-orange-500">{{ $segment->name }}</a></li>
            <li>/</li>
            <li><a href="{{ route('segments.category', [$segment->slug, $category->slug]) }}" class="hover:text-orange-500">{{ $category->name }}</a></li>
            <li>/</li>
            <li class="text-gray-900">{{ $subcategory->name }}</li>
        </ol>
    </nav>

    <div class="flex flex-col md:flex-row gap-8">
        {{-- Sidebar --}}
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                <h3 class="font-bold mb-4">{{ $category->name }}</h3>
                <ul class="space-y-2">
                    @foreach($subcategories as $sub)
                        <li>
                            <a 
                                href="{{ route('segments.subcategory', [$segment->slug, $category->slug, $sub->slug]) }}"
                                class="block py-1 {{ $sub->id === $subcategory->id ? 'text-orange-500 font-medium' : 'text-gray-600 hover:text-orange-500' }}"
                            >
                                {{ $sub->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        {{-- Products --}}
        <div class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">{{ $subcategory->name }}</h1>
                <p class="text-gray-600">{{ $products->total() }} produtos</p>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
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
                    <p class="text-gray-500">Nenhum produto encontrado</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection