<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'hex_code',
        'color_family',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_colors')
                    ->withTimestamps();
    }

    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    public function getStyleAttribute(): string
    {
        return "background-color: {$this->hex_code};";
    }

    public function getProductsCountAttribute(): int
    {
        return $this->products()->where('is_active', true)->count();
    }
}