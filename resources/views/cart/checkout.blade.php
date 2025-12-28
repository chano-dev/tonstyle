@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-8">Finalizar Compra</h1>

    <form action="{{ route('cart.process') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Customer Info --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Contact --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="font-bold text-lg mb-4">Dados de Contacto</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nome Completo *</label>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ old('name', auth()->user()?->name) }}"
                                class="w-full border rounded-lg px-4 py-2 @error('name') border-red-500 @enderror"
                                required
                            >
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Telefone *</label>
                            <input 
                                type="tel" 
                                name="phone" 
                                value="{{ old('phone', auth()->user()?->phone) }}"
                                placeholder="9XX XXX XXX"
                                class="w-full border rounded-lg px-4 py-2 @error('phone') border-red-500 @enderror"
                                required
                            >
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ old('email', auth()->user()?->email) }}"
                                class="w-full border rounded-lg px-4 py-2"
                            >
                        </div>
                    </div>
                </div>

                {{-- Delivery Address --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="font-bold text-lg mb-4">Endereço de Entrega</h2>

                    @if($addresses->count() > 0)
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">Moradas Guardadas</label>
                            <select name="address_id" class="w-full border rounded-lg px-4 py-2" onchange="toggleAddressFields(this)">
                                <option value="">Inserir nova morada</option>
                                @foreach($addresses as $address)
                                    <option value="{{ $address->id }}">
                                        {{ $address->label }}: {{ $address->street }}, {{ $address->neighborhood }}, {{ $address->city }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div id="address-fields" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Rua *</label>
                            <input 
                                type="text" 
                                name="delivery_street" 
                                value="{{ old('delivery_street') }}"
                                class="w-full border rounded-lg px-4 py-2"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Bairro *</label>
                            <input 
                                type="text" 
                                name="delivery_neighborhood" 
                                value="{{ old('delivery_neighborhood') }}"
                                class="w-full border rounded-lg px-4 py-2"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Cidade *</label>
                            <input 
                                type="text" 
                                name="delivery_city" 
                                value="{{ old('delivery_city', 'Luanda') }}"
                                class="w-full border rounded-lg px-4 py-2"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Província *</label>
                            <select name="delivery_province" class="w-full border rounded-lg px-4 py-2">
                                <option value="Luanda" selected>Luanda</option>
                                <option value="Benguela">Benguela</option>
                                <option value="Huambo">Huambo</option>
                                <option value="Huíla">Huíla</option>
                                <option value="Cabinda">Cabinda</option>
                                <option value="Outro">Outra</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="font-bold text-lg mb-4">Observações</h2>
                    <textarea 
                        name="notes" 
                        rows="3" 
                        placeholder="Instruções especiais para entrega..."
                        class="w-full border rounded-lg px-4 py-2"
                    >{{ old('notes') }}</textarea>
                </div>
            </div>

            {{-- Order Summary --}}
            <div>
                <div class="bg-white rounded-lg shadow p-6 sticky top-24">
                    <h2 class="font-bold text-lg mb-4">Resumo do Pedido</h2>
                    
                    {{-- Items --}}
                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        @foreach($cart->items as $item)
                            <div class="flex items-center text-sm">
                                <span class="flex-1">{{ $item->product->name }} × {{ $item->quantity }}</span>
                                <span>{{ number_format($item->subtotal, 0, ',', '.') }} Kz</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t mt-4 pt-4 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal</span>
                            <span>{{ number_format($cart->subtotal, 0, ',', '.') }} Kz</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Entrega</span>
                            <span>A combinar</span>
                        </div>
                    </div>

                    <div class="border-t mt-4 pt-4">
                        <div class="flex justify-between font-bold text-lg">
                            <span>Total</span>
                            <span class="text-orange-500">{{ number_format($cart->total, 0, ',', '.') }} Kz</span>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-green-500 text-white py-4 rounded-lg mt-6 font-semibold hover:bg-green-600 transition text-lg">
                        💬 Enviar Pedido via WhatsApp
                    </button>

                    <p class="text-xs text-gray-500 text-center mt-4">
                        Ao clicar, serás redirecionado para o WhatsApp para confirmar o pedido
                    </p>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function toggleAddressFields(select) {
    const fields = document.getElementById('address-fields');
    if (select.value) {
        fields.style.display = 'none';
    } else {
        fields.style.display = 'grid';
    }
}
</script>
@endsection