@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col md:flex-row gap-8">
        {{-- Sidebar Filtros --}}
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                <h3 class="font-bold text-lg mb-4">Filtros</h3>
                
                <form action="{{ route('products.index') }}" method="GET">
                    {{-- Categorias --}}
                    <div class="mb-6">
                        <h4 class="font-medium mb-2">Categoria</h4>
                        <select name="category" class="w-full border rounded-lg px-3 py-2">
                            <option value="">Todas</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Cores --}}
                    <div class="mb-6">
                        <h4 class="font-medium mb-2">Cor</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($colors->take(10) as $color)
                                <label class="cursor-pointer">
                                    <input type="radio" name="color" value="{{ $color->slug }}" class="hidden peer" {{ request('color') == $color->slug ? 'checked' : '' }}>
                                    <span 
                                        class="w-6 h-6 rounded-full border-2 block peer-checked:ring-2 peer-checked:ring-orange-500"
                                        style="background-color: {{ $color->hex_code }}"
                                        title="{{ $color->name }}"
                                    ></span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Tamanhos --}}
                    <div class="mb-6">
                        <h4 class="font-medium mb-2">Tamanho</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($sizes->take(8) as $size)
                                <label class="cursor-pointer">
                                    <input type="radio" name="size" value="{{ $size->slug }}" class="hidden peer" {{ request('size') == $size->slug ? 'checked' : '' }}>
                                    <span class="px-3 py-1 border rounded text-sm peer-checked:bg-orange-500 peer-checked:text-white peer-checked:border-orange-500">
                                        {{ $size->name }}
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Tipo de Corpo --}}
                    <div class="mb-6">
                        <h4 class="font-medium mb-2">Tipo de Corpo ⭐</h4>
                        <select name="body_type" class="w-full border rounded-lg px-3 py-2">
                            <option value="">Todos</option>
                            @foreach($bodyTypes as $bodyType)
                                <option value="{{ $bodyType->slug }}" {{ request('body_type') == $bodyType->slug ? 'selected' : '' }}>
                                    {{ $bodyType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Preço --}}
                    <div class="mb-6">
                        <h4 class="font-medium mb-2">Preço</h4>
                        <div class="flex gap-2">
                            <input type="number" name="price_min" placeholder="Min" value="{{ request('price_min') }}" class="w-1/2 border rounded-lg px-3 py-2 text-sm">
                            <input type="number" name="price_max" placeholder="Max" value="{{ request('price_max') }}" class="w-1/2 border rounded-lg px-3 py-2 text-sm">
                        </div>
                    </div>

                    {{-- Promoção --}}
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="on_sale" value="1" {{ request('on_sale') ? 'checked' : '' }} class="mr-2">
                            <span>Apenas promoções</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-orange-500 text-white py-2 rounded-lg hover:bg-orange-600 transition">
                        Aplicar Filtros
                    </button>
                    
                    <a href="{{ route('products.index') }}" class="block text-center text-gray-500 text-sm mt-2 hover:underline">
                        Limpar filtros
                    </a>
                </form>
            </div>
        </aside>

        {{-- Products Grid --}}
        <div class="flex-1">
            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <p class="text-gray-600">{{ $products->total() }} produtos encontrados</p>
                <select onchange="window.location.href=this.value" class="border rounded-lg px-3 py-2">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>
                        Mais recentes
                    </option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                        Preço: menor → maior
                    </option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                        Preço: maior → menor
                    </option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'bestseller']) }}" {{ request('sort') == 'bestseller' ? 'selected' : '' }}>
                        Mais vendidos
                    </option>
                </select>
            </div>

            {{-- Grid --}}
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
                    <p class="text-gray-500 text-lg">Nenhum produto encontrado</p>
                    <a href="{{ route('products.index') }}" class="text-orange-500 hover:underline mt-2 inline-block">
                        Ver todos os produtos
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection