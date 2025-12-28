{{-- Card de Produto --}}
@props(['product'])

<div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow group">
    {{-- Image --}}
    <a href="{{ route('products.show', $product->slug) }}" class="block relative overflow-hidden rounded-t-lg">
        @if($product->images->where('is_primary', true)->first())
            <img 
                src="{{ asset('storage/' . $product->images->where('is_primary', true)->first()->file_path) }}" 
                alt="{{ $product->name }}"
                class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-300"
            >
        @else
            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                <span class="text-gray-400">Sem imagem</span>
            </div>
        @endif
        
        {{-- Badges --}}
        <div class="absolute top-2 left-2 flex flex-col gap-1">
            @if($product->is_new)
                <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded">Novo</span>
            @endif
            @if($product->is_on_sale && $product->discount_percentage > 0)
                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded">-{{ $product->discount_percentage }}%</span>
            @endif
            @if($product->is_trending)
                <span class="bg-orange-500 text-white text-xs px-2 py-1 rounded">🔥 Tendência</span>
            @endif
        </div>
        
        {{-- Quick Actions --}}
        <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity">
            <button class="bg-white p-2 rounded-full shadow hover:bg-gray-100" title="Adicionar aos favoritos">
                ❤️
            </button>
        </div>
    </a>
    
    {{-- Info --}}
    <div class="p-4">
        {{-- Category --}}
        <p class="text-xs text-gray-500 mb-1">
            {{ $product->subcategory->name ?? '' }}
        </p>
        
        {{-- Name --}}
        <a href="{{ route('products.show', $product->slug) }}">
            <h3 class="font-medium text-gray-900 hover:text-orange-500 line-clamp-2">
                {{ $product->name }}
            </h3>
        </a>
        
        {{-- Brand --}}
        @if($product->brand)
            <p class="text-xs text-gray-400 mt-1">{{ $product->brand->name }}</p>
        @endif
        
        {{-- Price --}}
        <div class="mt-2 flex items-center gap-2">
            @if($product->discount_percentage > 0)
                <span class="text-lg font-bold text-red-500">
                    {{ number_format($product->price_sell * (1 - $product->discount_percentage/100), 0, ',', '.') }} Kz
                </span>
                <span class="text-sm text-gray-400 line-through">
                    {{ number_format($product->price_sell, 0, ',', '.') }} Kz
                </span>
            @else
                <span class="text-lg font-bold text-gray-900">
                    {{ number_format($product->price_sell, 0, ',', '.') }} Kz
                </span>
            @endif
        </div>
        
        {{-- Colors Available --}}
        @if($product->colors->count() > 0)
            <div class="flex items-center gap-1 mt-2">
                @foreach($product->colors->take(5) as $color)
                    <span 
                        class="w-4 h-4 rounded-full border border-gray-300" 
                        style="background-color: {{ $color->hex_code }}"
                        title="{{ $color->name }}"
                    ></span>
                @endforeach
                @if($product->colors->count() > 5)
                    <span class="text-xs text-gray-400">+{{ $product->colors->count() - 5 }}</span>
                @endif
            </div>
        @endif
        
        {{-- Stock Status --}}
        @php
            $totalStock = $product->variations->sum('stock_quantity') - $product->variations->sum('stock_reserved');
        @endphp
        @if($totalStock <= 0)
            <p class="text-xs text-red-500 mt-2">Esgotado</p>
        @elseif($totalStock <= 5)
            <p class="text-xs text-orange-500 mt-2">Últimas unidades!</p>
        @endif
    </div>
</div>