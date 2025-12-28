<?php

namespace App\Http\Controllers;


//use App\Models\UserAddress;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Segment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Ver carrinho
     */
    public function index()
    {
        $cart = $this->getOrCreateCart();
        $cart->load(['items.product.images', 'items.variation.color', 'items.variation.size']);

        $segments = Segment::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('cart.index', compact('cart', 'segments'));
    }

    /**
     * Adicionar item ao carrinho
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'variation_id' => 'nullable|exists:product_variations,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        $product = Product::findOrFail($request->product_id);
        $variation = $request->variation_id 
            ? ProductVariation::findOrFail($request->variation_id) 
            : null;

        // Verificar stock
        if ($variation && $variation->stock_available < $request->quantity) {
            return back()->with('error', 'Stock insuficiente para esta variação.');
        }

        $cart = $this->getOrCreateCart();

        // Verificar se já existe no carrinho
        $existingItem = $cart->items()
            ->where('product_id', $product->id)
            ->where('variation_id', $variation?->id)
            ->first();

        if ($existingItem) {
            // Actualizar quantidade
            $newQuantity = $existingItem->quantity + $request->quantity;
            
            if ($variation && $variation->stock_available < $newQuantity) {
                return back()->with('error', 'Stock insuficiente para a quantidade total.');
            }

            $existingItem->update([
                'quantity' => $newQuantity,
                'subtotal' => $existingItem->unit_price * $newQuantity,
            ]);
        } else {
            // Criar novo item
            $unitPrice = $variation 
                ? $product->price_sell + $variation->price_adjustment 
                : $product->price_sell;

            // Aplicar desconto se houver
            if ($product->discount_percentage > 0) {
                $unitPrice = $unitPrice * (1 - $product->discount_percentage / 100);
            }

            $cart->items()->create([
                'product_id' => $product->id,
                'variation_id' => $variation?->id,
                'quantity' => $request->quantity,
                'unit_price' => $unitPrice,
                'discount_percentage' => $product->discount_percentage,
                'subtotal' => $unitPrice * $request->quantity,
                'needs_confirmation' => false,
            ]);

            // Reservar stock
            if ($variation) {
                $variation->increment('stock_reserved', $request->quantity);
            }
        }

        // Recalcular totais do carrinho
        $cart->recalculateTotals();

        return back()->with('success', 'Produto adicionado ao carrinho!');
    }

    /**
     * Actualizar quantidade de um item
     */
    public function update(Request $request, CartItem $item)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        // Verificar se o item pertence ao carrinho do utilizador
        $cart = $this->getOrCreateCart();
        if ($item->cart_id !== $cart->id) {
            abort(403);
        }

        $oldQuantity = $item->quantity;
        $newQuantity = $request->quantity;

        // Verificar stock
        if ($item->variation) {
            $availableStock = $item->variation->stock_quantity - $item->variation->stock_reserved + $oldQuantity;
            if ($availableStock < $newQuantity) {
                return back()->with('error', 'Stock insuficiente.');
            }

            // Actualizar reserva
            $diff = $newQuantity - $oldQuantity;
            $item->variation->increment('stock_reserved', $diff);
        }

        $item->update([
            'quantity' => $newQuantity,
            'subtotal' => $item->unit_price * $newQuantity,
        ]);

        $cart->recalculateTotals();

        return back()->with('success', 'Quantidade actualizada!');
    }

    /**
     * Remover item do carrinho
     */
    public function remove(CartItem $item)
    {
        // Verificar se o item pertence ao carrinho do utilizador
        $cart = $this->getOrCreateCart();
        if ($item->cart_id !== $cart->id) {
            abort(403);
        }

        // Liberar stock reservado
        if ($item->variation) {
            $item->variation->decrement('stock_reserved', $item->quantity);
        }

        $item->delete();
        $cart->recalculateTotals();

        return back()->with('success', 'Produto removido do carrinho.');
    }

    /**
     * Limpar carrinho
     */
    public function clear()
    {
        $cart = $this->getOrCreateCart();

        // Liberar todo o stock reservado
        foreach ($cart->items as $item) {
            if ($item->variation) {
                $item->variation->decrement('stock_reserved', $item->quantity);
            }
        }

        $cart->items()->delete();
        $cart->recalculateTotals();

        return back()->with('success', 'Carrinho limpo.');
    }

    /**
     * Página de checkout (dados de entrega)
     */
    public function checkout()
    {
        $cart = $this->getOrCreateCart();
        $cart->load(['items.product.images', 'items.variation']);

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'O carrinho está vazio.');
        }

        $segments = Segment::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        $user = Auth::user();
        $addresses = $user ? $user->addresses()->where('is_active', true)->get() : collect();

        return view('cart.checkout', compact('cart', 'segments', 'addresses'));
    }

    /**
     * Guardar dados de entrega e gerar link WhatsApp
     */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address_id' => 'nullable|exists:user_addresses,id',
            'delivery_street' => 'required_without:address_id|nullable|string|max:255',
            'delivery_neighborhood' => 'required_without:address_id|nullable|string|max:255',
            'delivery_city' => 'required_without:address_id|nullable|string|max:255',
            'delivery_province' => 'required_without:address_id|nullable|string|max:255',
            'notes' => 'nullable|string|max:1000',
        ]);

        $cart = $this->getOrCreateCart();

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'O carrinho está vazio.');
        }

        // Actualizar dados do carrinho
        $cart->update([
            'guest_name' => $request->name,
            'guest_phone' => $request->phone,
            'guest_email' => $request->email,
            'user_address_id' => $request->address_id,
            'delivery_street' => $request->delivery_street,
            'delivery_neighborhood' => $request->delivery_neighborhood,
            'delivery_city' => $request->delivery_city,
            'delivery_province' => $request->delivery_province,
            'customer_notes' => $request->notes,
        ]);

        // Gerar link do WhatsApp
        $whatsappLink = $cart->getWhatsappOrderLink();

        // Registar log
        $cart->whatsappLogs()->create([
            'phone_number' => '244928496036', // Número da loja
            'message_content' => $cart->generateWhatsappMessage(),
            'sent_at' => now(),
            'status' => 'pending',
        ]);

        return redirect()->away($whatsappLink);
    }

    /**
     * Obter ou criar carrinho
     */
    private function getOrCreateCart(): Cart
    {
        $user = Auth::user();
        $sessionId = session()->getId();

        if ($user) {
            // Utilizador logado
            $cart = Cart::where('user_id', $user->id)
                ->where('status', 'active')
                ->first();

            if (!$cart) {
                // Verificar se há carrinho de sessão para migrar
                $sessionCart = Cart::where('session_id', $sessionId)
                    ->where('status', 'active')
                    ->first();

                if ($sessionCart) {
                    $sessionCart->update(['user_id' => $user->id]);
                    $cart = $sessionCart;
                } else {
                    $cart = Cart::create([
                        'user_id' => $user->id,
                        'cart_token' => Cart::generateToken(),
                        'status' => 'active',
                        'expires_at' => now()->addDays(30),
                    ]);
                }
            }
        } else {
            // Visitante (sessão)
            $cart = Cart::where('session_id', $sessionId)
                ->where('status', 'active')
                ->first();

            if (!$cart) {
                $cart = Cart::create([
                    'session_id' => $sessionId,
                    'cart_token' => Cart::generateToken(),
                    'status' => 'active',
                    'expires_at' => now()->addDays(7),
                ]);
            }
        }

        return $cart;
    }

    /**
     * API: Obter contagem de itens (para header)
     */
    public function count()
    {
        $cart = $this->getOrCreateCart();
        return response()->json([
            'count' => $cart->items->sum('quantity'),
        ]);
    }
}