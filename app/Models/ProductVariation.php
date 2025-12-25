<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
        'sku_variation',
        'price_adjustment',
        'stock_quantity',
        'stock_reserved',
        'stock_min',
        'image_path',
        'is_active',
    ];

    protected $casts = [
        'price_adjustment' => 'decimal:2',
        'stock_quantity' => 'integer',
        'stock_reserved' => 'integer',
        'stock_min' => 'integer',
        'is_active' => 'boolean',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'variation_id');
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class, 'variation_id');
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->whereRaw('stock_quantity > stock_reserved');
    }

    public function scopeLowStock($query)
    {
        return $query->whereRaw('stock_quantity <= stock_min')
                     ->where('stock_min', '>', 0);
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    /**
     * Stock disponível (total - reservado)
     */
    public function getStockAvailableAttribute(): int
    {
        return max(0, $this->stock_quantity - $this->stock_reserved);
    }

    /**
     * Verifica se tem stock
     */
    public function getInStockAttribute(): bool
    {
        return $this->stock_available > 0;
    }

    /**
     * Verifica se stock está baixo
     */
    public function getLowStockAttribute(): bool
    {
        return $this->stock_min > 0 && $this->stock_quantity <= $this->stock_min;
    }

    /**
     * Preço final da variação
     */
    public function getFinalPriceAttribute(): float
    {
        return $this->product->final_price + $this->price_adjustment;
    }

    /**
     * Nome completo da variação
     * Exemplo: "Vermelho - M"
     */
    public function getFullNameAttribute(): string
    {
        $parts = [];
        
        if ($this->color) {
            $parts[] = $this->color->name;
        }
        if ($this->size) {
            $parts[] = $this->size->name;
        }
        
        return implode(' - ', $parts) ?: 'Padrão';
    }

    /**
     * URL da imagem (própria ou do produto)
     */
    public function getImageUrlAttribute(): ?string
    {
        if ($this->image_path) {
            return asset('storage/' . $this->image_path);
        }
        return $this->product->primary_image_url;
    }

    // ==========================================
    // MÉTODOS
    // ==========================================

    /**
     * Reservar stock (quando adiciona ao carrinho)
     */
    public function reserveStock(int $quantity): bool
    {
        if ($this->stock_available < $quantity) {
            return false;
        }

        $this->increment('stock_reserved', $quantity);
        return true;
    }

    /**
     * Liberar stock reservado
     */
    public function releaseStock(int $quantity): void
    {
        $this->decrement('stock_reserved', min($quantity, $this->stock_reserved));
    }

    /**
     * Confirmar venda (reduz stock real)
     */
    public function confirmSale(int $quantity): bool
    {
        if ($this->stock_quantity < $quantity) {
            return false;
        }

        $this->decrement('stock_quantity', $quantity);
        $this->decrement('stock_reserved', min($quantity, $this->stock_reserved));
        
        return true;
    }

    /**
     * Gerar SKU da variação
     */
    public static function generateSkuVariation(Product $product, ?Color $color, ?Size $size): string
    {
        $sku = $product->sku;
        
        if ($color) {
            $sku .= '-' . strtoupper(substr($color->slug, 0, 3));
        }
        if ($size) {
            $sku .= '-' . strtoupper($size->name);
        }
        
        return $sku;
    }
}