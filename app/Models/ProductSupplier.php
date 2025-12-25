<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSupplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'supplier_id',
        'cost_price',
        'commission_percentage',
        'is_preferred',
        'lead_time_days',
        'min_order_quantity',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'cost_price' => 'decimal:2',
        'commission_percentage' => 'decimal:2',
        'is_preferred' => 'boolean',
        'lead_time_days' => 'integer',
        'min_order_quantity' => 'integer',
        'is_active' => 'boolean',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePreferred($query)
    {
        return $query->where('is_preferred', true);
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    /**
     * Margem de lucro
     */
    public function getProfitMarginAttribute(): ?float
    {
        if (!$this->cost_price || $this->cost_price == 0) {
            return null;
        }

        $sellPrice = $this->product->price_sell;
        return round((($sellPrice - $this->cost_price) / $this->cost_price) * 100, 2);
    }

    /**
     * Valor da comissão em Kwanzas (para consignação)
     */
    public function getCommissionAmountAttribute(): float
    {
        if (!$this->commission_percentage) {
            return 0;
        }
        return round($this->product->price_sell * $this->commission_percentage / 100, 2);
    }
}