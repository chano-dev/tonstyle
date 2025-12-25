<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'cart_token',
        'guest_name',
        'guest_email',
        'guest_phone',
        'user_address_id',
        'delivery_street',
        'delivery_number',
        'delivery_neighborhood',
        'delivery_city',
        'delivery_province',
        'delivery_landmark',
        'subtotal',
        'discount_amount',
        'delivery_fee',
        'total',
        'status',
        'customer_notes',
        'internal_notes',
        'expires_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
        'total' => 'decimal:2',
        'expires_at' => 'datetime',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userAddress(): BelongsTo
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeAbandoned($query)
    {
        return $query->where('status', 'abandoned');
    }

    public function scopeConverted($query)
    {
        return $query->where('status', 'converted');
    }

    public function scopeForSession($query, $sessionId)
    {
        return $query->where('session_id', $sessionId);
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    public function getItemsCountAttribute(): int
    {
        return $this->items()->sum('quantity');
    }

    public function getIsEmptyAttribute(): bool
    {
        return $this->items()->count() === 0;
    }

    public function getIsGuestAttribute(): bool
    {
        return $this->user_id === null;
    }

    public function getCustomerNameAttribute(): ?string
    {
        return $this->user?->name ?? $this->guest_name;
    }

    public function getCustomerPhoneAttribute(): ?string
    {
        return $this->user?->phone ?? $this->guest_phone;
    }

    public function getDeliveryAddressAttribute(): string
    {
        if ($this->userAddress) {
            return $this->userAddress->full_address;
        }

        $parts = [];
        if ($this->delivery_street) {
            $address = $this->delivery_street;
            if ($this->delivery_number) $address .= ', ' . $this->delivery_number;
            $parts[] = $address;
        }
        if ($this->delivery_neighborhood) $parts[] = $this->delivery_neighborhood;
        if ($this->delivery_city) $parts[] = $this->delivery_city;

        return implode(' - ', $parts) ?: 'Endereço não definido';
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->expires_at && $this->expires_at < now();
    }

    // ==========================================
    // MÉTODOS
    // ==========================================

    /**
     * Gerar token único
     */
    public static function generateToken(): string
    {
        do {
            $token = Str::random(32);
        } while (self::where('cart_token', $token)->exists());

        return $token;
    }

    /**
     * Recalcular totais
     */
    public function recalculateTotals(): void
    {
        $subtotal = $this->items()->sum('subtotal');
        
        $this->update([
            'subtotal' => $subtotal,
            'total' => $subtotal - $this->discount_amount + $this->delivery_fee,
        ]);
    }

    /**
     * Adicionar item ao carrinho
     */
    public function addItem(Product $product, ?ProductVariation $variation = null, int $quantity = 1): CartItem
    {
        // Verificar se já existe
        $existingItem = $this->items()
            ->where('product_id', $product->id)
            ->where('variation_id', $variation?->id)
            ->first();

        if ($existingItem) {
            $existingItem->increment('quantity', $quantity);
            $existingItem->updateSubtotal();
            $this->recalculateTotals();
            return $existingItem;
        }

        // Criar novo item
        $unitPrice = $variation?->final_price ?? $product->final_price;
        
        $item = $this->items()->create([
            'product_id' => $product->id,
            'variation_id' => $variation?->id,
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'discount_percentage' => $product->discount_percentage,
            'subtotal' => $unitPrice * $quantity,
            'needs_confirmation' => false,
        ]);

        // Reservar stock
        $variation?->reserveStock($quantity);

        $this->recalculateTotals();
        return $item;
    }

    /**
     * Gerar mensagem para WhatsApp
     */
    public function generateWhatsappMessage(): string
    {
        $message = "🛒 *PEDIDO - TEU ESTILO*\n\n";
        
        if ($this->customer_name) {
            $message .= "👤 Cliente: {$this->customer_name}\n";
        }
        if ($this->customer_phone) {
            $message .= "📱 Telefone: {$this->customer_phone}\n";
        }
        $message .= "\n📦 *ITENS:*\n";
        
        foreach ($this->items as $item) {
            $message .= "• {$item->product->name}";
            if ($item->variation) {
                $message .= " ({$item->variation->full_name})";
            }
            $message .= " x{$item->quantity}";
            $message .= " = " . number_format($item->subtotal, 2, ',', '.') . " Kz\n";
        }

        $message .= "\n💰 *TOTAL: " . number_format($this->total, 2, ',', '.') . " Kz*\n";

        if ($this->customer_notes) {
            $message .= "\n📝 Notas: {$this->customer_notes}\n";
        }

        $message .= "\n🔗 Token: {$this->cart_token}";

        return $message;
    }

    /**
     * Link direto para WhatsApp da loja
     */
    public function getWhatsappOrderLink(): string
    {
        $phone = '244928496036'; // Número da Teu Estilo
        $message = urlencode($this->generateWhatsappMessage());
        return "https://wa.me/{$phone}?text={$message}";
    }

    /**
     * Marcar como convertido (venda concluída)
     */
    public function markAsConverted(): void
    {
        $this->update(['status' => 'converted']);

        foreach ($this->items as $item) {
            $item->variation?->confirmSale($item->quantity);
            $item->product->incrementSales($item->quantity);
        }
    }

    /**
     * Marcar como abandonado
     */
    public function markAsAbandoned(): void
    {
        $this->update(['status' => 'abandoned']);

        foreach ($this->items as $item) {
            $item->variation?->releaseStock($item->quantity);
        }
    }

    /**
     * Obter ou criar carrinho para sessão
     */
    public static function getOrCreateForSession(string $sessionId): self
    {
        return self::firstOrCreate(
            ['session_id' => $sessionId, 'status' => 'active'],
            [
                'cart_token' => self::generateToken(),
                'expires_at' => now()->addDays(7),
            ]
        );
    }
}