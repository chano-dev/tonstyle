@extends('layouts.app')

@section('title', $product->name)
@section('meta_description', $product->meta_description ?? $product->short_description)

@section('content')
<div class="container mx-auto px-4 py-8">
    {{-- Breadcrumb --}}
    <nav class="text-sm mb-6">
        <ol class="flex items-center space-x-2 text-gray-500">
            <li><a href="{{ route('home') }}" class="hover:text-orange-500">Início</a></li>
            <li>/</li>
            <li><a href="{{ route('segments.show', $product->subcategory->segment->slug) }}" class="hover:text-orange-500">{{ $product->subcategory->segment->name }}</a></li>
            <li>/</li>
            <li><a href="{{ route('segments.category', [$product->subcategory->segment->slug, $product->subcategory->category->slug]) }}" class="hover:text-orange-500">{{ $product->subcategory->category->name }}</a></li>
            <li>/</li>
            <li class="text-gray-900">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        {{-- Gallery --}}
        <div>
            {{-- Main Image --}}
            <div class="bg-gray-100 rounded-lg overflow-hidden mb-4">
                @if($product->images->count() > 0)
                    <img 
                        id="main-image"
                        src="{{ asset('storage/' . $product->images->first()->file_path) }}" 
                        alt="{{ $product->name }}"
                        class="w-full h-96 object-cover"
                    >
                @else
                    <div class="w-full h-96 flex items-center justify-center text-gray-400">
                        Sem imagem
                    </div>
                @endif
            </div>
            
            {{-- Thumbnails --}}
            @if($product->images->count() > 1)
                <div class="flex gap-2 overflow-x-auto">
                    @foreach($product->images as $image)
                        <button 
                            onclick="document.getElementById('main-image').src='{{ asset('storage/' . $image->file_path) }}'"
                            class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 hover:border-orange-500 transition"
                        >
                            <img src="{{ asset('storage/' . $image->file_path) }}" alt="" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div>
            {{-- Brand --}}
            @if($product->brand)
                <p class="text-sm text-gray-500 mb-2">{{ $product->brand->name }}</p>
            @endif
            
            {{-- Name --}}
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
            
            {{-- Price --}}
            <div class="mb-6">
                @if($product->discount_percentage > 0)
                    <span class="text-3xl font-bold text-red-500">
                        {{ number_format($product->price_sell * (1 - $product->discount_percentage/100), 0, ',', '.') }} Kz
                    </span>
                    <span class="text-xl text-gray-400 line-through ml-2">
                        {{ number_format($product->price_sell, 0, ',', '.') }} Kz
                    </span>
                    <span class="bg-red-500 text-white text-sm px-2 py-1 rounded ml-2">
                        -{{ $product->discount_percentage }}%
                    </span>
                @else
                    <span class="text-3xl font-bold text-gray-900">
                        {{ number_format($product->price_sell, 0, ',', '.') }} Kz
                    </span>
                @endif
            </div>

            {{-- Short Description --}}
            @if($product->short_description)
                <p class="text-gray-600 mb-6">{{ $product->short_description }}</p>
            @endif

            {{-- Add to Cart Form --}}
            <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                {{-- Color Selection --}}
                @if($product->colors->count() > 0)
                    <div>
                        <label class="block font-medium mb-2">Cor</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->colors as $color)
                                <label class="cursor-pointer">
                                    <input type="radio" name="selected_color" value="{{ $color->id }}" class="hidden peer" required>
                                    <span 
                                        class="w-10 h-10 rounded-full border-2 block peer-checked:ring-2 peer-checked:ring-orange-500 peer-checked:ring-offset-2"
                                        style="background-color: {{ $color->hex_code }}"
                                        title="{{ $color->name }}"
                                    ></span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Size Selection --}}
                @if($product->sizes->count() > 0)
                    <div>
                        <label class="block font-medium mb-2">Tamanho</label>
                        <div class="flex flex-wrap gap-2">
                            @foreach($product->sizes as $size)
                                <label class="cursor-pointer">
                                    <input type="radio" name="selected_size" value="{{ $size->id }}" class="hidden peer" required>
                                    <span class="px-4 py-2 border-2 rounded block peer-checked:bg-orange-500 peer-checked:text-white peer-checked:border-orange-500 hover:border-gray-400 transition">
                                        {{ $size->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Quantity --}}
                <div>
                    <label class="block font-medium mb-2">Quantidade</label>
                    <select name="quantity" class="border rounded-lg px-4 py-2">
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                {{-- Add to Cart Button --}}
                <button type="submit" class="w-full bg-orange-500 text-white py-4 rounded-lg font-semibold hover:bg-orange-600 transition text-lg">
                    🛒 Adicionar ao Carrinho
                </button>
            </form>

            {{-- WhatsApp Direct --}}
            <a 
                href="https://wa.me/244928496036?text=Olá! Tenho interesse no produto: {{ $product->name }} ({{ $product->sku }})"
                target="_blank"
                class="block text-center mt-4 border-2 border-green-500 text-green-500 py-3 rounded-lg font-semibold hover:bg-green-500 hover:text-white transition"
            >
                💬 Comprar via WhatsApp
            </a>

            {{-- Product Details --}}
            <div class="mt-8 border-t pt-8">
                <h3 class="font-bold text-lg mb-4">Detalhes do Produto</h3>
                
                <dl class="space-y-2 text-sm">
                    <div class="flex">
                        <dt class="w-32 text-gray-500">SKU:</dt>
                        <dd>{{ $product->sku }}</dd>
                    </div>
                    <div class="flex">
                        <dt class="w-32 text-gray-500">Condição:</dt>
                        <dd>{{ $product->condition === 'new' ? 'Novo' : ($product->condition === 'used' ? 'Usado' : 'Semi-novo') }}</dd>
                    </div>
                    @if($product->materials->count() > 0)
                        <div class="flex">
                            <dt class="w-32 text-gray-500">Material:</dt>
                            <dd>{{ $product->materials->pluck('name')->join(', ') }}</dd>
                        </div>
                    @endif
                    @if($product->occasions->count() > 0)
                        <div class="flex">
                            <dt class="w-32 text-gray-500">Ocasião:</dt>
                            <dd>{{ $product->occasions->pluck('name')->join(', ') }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            {{-- Body Types --}}
            @if($product->bodyTypes->count() > 0)
                <div class="mt-6 bg-orange-50 p-4 rounded-lg">
                    <h4 class="font-bold text-orange-800 mb-2">⭐ Recomendado para:</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->bodyTypes as $bodyType)
                            <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm">
                                {{ $bodyType->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Description --}}
    @if($product->description)
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Descrição</h2>
            <div class="prose max-w-none">
                {!! nl2br(e($product->description)) !!}
            </div>
        </div>
    @endif

    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
        <section class="mt-16">
            <h2 class="text-2xl font-bold mb-6">Produtos Relacionados</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                    @include('components.product-card', ['product' => $relatedProduct])
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection