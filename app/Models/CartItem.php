<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'variation_id',
        'quantity',
        'unit_price',
        'discount_percentage',
        'subtotal',
        'needs_confirmation',
        'confirmed_at',
        'confirmed_by',
        'notes',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'quantity' => 'integer',
        'needs_confirmation' => 'boolean',
        'confirmed_at' => 'datetime',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variation(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class, 'variation_id');
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeNeedsConfirmation($query)
    {
        return $query->where('needs_confirmation', true)
                     ->whereNull('confirmed_at');
    }

    public function scopeConfirmed($query)
    {
        return $query->whereNotNull('confirmed_at');
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    public function getIsConfirmedAttribute(): bool
    {
        return $this->confirmed_at !== null;
    }

    public function getFullNameAttribute(): string
    {
        $name = $this->product->name;
        if ($this->variation) {
            $name .= ' - ' . $this->variation->full_name;
        }
        return $name;
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->variation?->image_url ?? $this->product->primary_image_url;
    }

    // ==========================================
    // MÉTODOS
    // ==========================================

    /**
     * Atualizar subtotal
     */
    public function updateSubtotal(): void
    {
        $this->update([
            'subtotal' => $this->unit_price * $this->quantity,
        ]);
    }

    /**
     * Alterar quantidade
     */
    public function updateQuantity(int $newQuantity): bool
    {
        if ($newQuantity <= 0) {
            return $this->remove();
        }

        $diff = $newQuantity - $this->quantity;

        // Verificar stock se aumentando
        if ($diff > 0 && $this->variation) {
            if ($this->variation->stock_available < $diff) {
                return false; // Stock insuficiente
            }
            $this->variation->reserveStock($diff);
        }

        // Liberar stock se diminuindo
        if ($diff < 0 && $this->variation) {
            $this->variation->releaseStock(abs($diff));
        }

        $this->update([
            'quantity' => $newQuantity,
            'subtotal' => $this->unit_price * $newQuantity,
        ]);

        $this->cart->recalculateTotals();
        return true;
    }

    /**
     * Remover item do carrinho
     */
    public function remove(): bool
    {
        // Liberar stock reservado
        if ($this->variation) {
            $this->variation->releaseStock($this->quantity);
        }

        $cart = $this->cart;
        $this->delete();
        $cart->recalculateTotals();

        return true;
    }

    /**
     * Confirmar disponibilidade (para consignação)
     */
    public function confirm(string $confirmedBy): void
    {
        $this->update([
            'confirmed_at' => now(),
            'confirmed_by' => $confirmedBy,
        ]);
    }
}