<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Size extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'size_type',
        'size_order',
        'eu_size',
        'us_size',
        'uk_size',
        'bust_cm',
        'waist_cm',
        'hip_cm',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'size_order' => 'integer',
        'bust_cm' => 'integer',
        'waist_cm' => 'integer',
        'hip_cm' => 'integer',
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_sizes')
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
        return $query->orderBy('size_order')->orderBy('display_order');
    }

    public function scopeClothing($query)
    {
        return $query->where('size_type', 'clothing');
    }

    public function scopeShoes($query)
    {
        return $query->where('size_type', 'shoes');
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    public function getMeasurementsAttribute(): ?string
    {
        $parts = [];
        if ($this->bust_cm) $parts[] = "Busto: {$this->bust_cm}cm";
        if ($this->waist_cm) $parts[] = "Cintura: {$this->waist_cm}cm";
        if ($this->hip_cm) $parts[] = "Quadril: {$this->hip_cm}cm";
        return $parts ? implode(', ', $parts) : null;
    }
}