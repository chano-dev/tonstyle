@extends('layouts.app')

@section('title', 'Carrinho')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-8">🛒 Carrinho de Compras</h1>

    @if($cart->items->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Cart Items --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow">
                    @foreach($cart->items as $item)
                        <div class="flex items-center p-4 border-b last:border-b-0">
                            {{-- Image --}}
                            <div class="w-20 h-20 flex-shrink-0">
                                @if($item->product->images->count() > 0)
                                    <img 
                                        src="{{ asset('storage/' . $item->product->images->first()->file_path) }}" 
                                        alt="{{ $item->product->name }}"
                                        class="w-full h-full object-cover rounded"
                                    >
                                @else
                                    <div class="w-full h-full bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">
                                        Sem img
                                    </div>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="ml-4 flex-1">
                                <a href="{{ route('products.show', $item->product->slug) }}" class="font-medium hover:text-orange-500">
                                    {{ $item->product->name }}
                                </a>
                                @if($item->variation)
                                    <p class="text-sm text-gray-500">
                                        {{ $item->variation->color?->name }} / {{ $item->variation->size?->name }}
                                    </p>
                                @endif
                                <p class="text-orange-500 font-semibold mt-1">
                                    {{ number_format($item->unit_price, 0, ',', '.') }} Kz
                                </p>
                            </div>

                            {{-- Quantity --}}
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PATCH')
                                    <select name="quantity" onchange="this.form.submit()" class="border rounded px-2 py-1">
                                        @for($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </form>
                            </div>

                            {{-- Subtotal --}}
                            <div class="ml-4 text-right w-24">
                                <p class="font-semibold">{{ number_format($item->subtotal, 0, ',', '.') }} Kz</p>
                            </div>

                            {{-- Remove --}}
                            <form action="{{ route('cart.remove', $item) }}" method="POST" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" title="Remover">
                                    ✕
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                {{-- Clear Cart --}}
                <form action="{{ route('cart.clear') }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline text-sm">
                        Limpar carrinho
                    </button>
                </form>
            </div>

            {{-- Summary --}}
            <div>
                <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                    <h2 class="font-bold text-lg mb-4">Resumo</h2>
                    
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal</span>
                            <span>{{ number_format($cart->subtotal, 0, ',', '.') }} Kz</span>
                        </div>
                        @if($cart->discount_amount > 0)
                            <div class="flex justify-between text-green-600">
                                <span>Desconto</span>
                                <span>-{{ number_format($cart->discount_amount, 0, ',', '.') }} Kz</span>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <span class="text-gray-500">Entrega</span>
                            <span>{{ $cart->delivery_fee > 0 ? number_format($cart->delivery_fee, 0, ',', '.') . ' Kz' : 'A calcular' }}</span>
                        </div>
                    </div>

                    <div class="border-t mt-4 pt-4">
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span class="text-orange-500">{{ number_format($cart->total, 0, ',', '.') }} Kz</span>
                        </div>
                    </div>

                    <a href="{{ route('cart.checkout') }}" class="block w-full bg-orange-500 text-white text-center py-3 rounded-lg mt-6 font-semibold hover:bg-orange-600 transition">
                        Finalizar Compra
                    </a>

                    <a href="{{ route('products.index') }}" class="block text-center text-gray-500 mt-4 hover:underline">
                        Continuar a comprar
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-xl mb-4">O teu carrinho está vazio</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-orange-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-orange-600 transition">
                Ver Produtos
            </a>
        </div>
    @endif
</div>
@endsection