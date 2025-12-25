<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo_path',
        'banner_path',
        'website',
        'country_origin',
        'is_active',
        'is_featured',
        'display_order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'display_order' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    /**
     * Brand tem MUITOS produtos
     * Exemplo: Zara → Vestido Zara, Blusa Zara...
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo_path 
            ? asset('storage/' . $this->logo_path)
            : null;
    }

    public function getBannerUrlAttribute(): ?string
    {
        return $this->banner_path 
            ? asset('storage/' . $this->banner_path)
            : null;
    }

    public function getProductsCountAttribute(): int
    {
        return $this->products()->where('is_active', true)->count();
    }
}