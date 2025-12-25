<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductService extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'service_id',
        'is_included',
        'additional_price',
        'discount_percentage',
        'is_required',
        'is_recommended',
        'display_order',
        'is_active',
    ];

    protected $casts = [
        'is_included' => 'boolean',
        'additional_price' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'is_required' => 'boolean',
        'is_recommended' => 'boolean',
        'display_order' => 'integer',
        'is_active' => 'boolean',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    public function scopeRecommended($query)
    {
        return $query->where('is_recommended', true);
    }

    public function scopeIncluded($query)
    {
        return $query->where('is_included', true);
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    /**
     * Preço final do serviço (com desconto se aplicável)
     */
    public function getFinalPriceAttribute(): float
    {
        if ($this->is_included) {
            return 0;
        }

        $price = $this->additional_price ?? $this->service->base_price;
        
        if ($this->discount_percentage > 0) {
            $price = $price * (1 - $this->discount_percentage / 100);
        }

        return round($price, 2);
    }
}