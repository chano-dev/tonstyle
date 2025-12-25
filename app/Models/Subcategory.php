<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'segment_id',
        'name',
        'slug',
        'sku_code',
        'description',
        'image_path',
        'is_active',
        'display_order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    /**
     * Subcategory PERTENCE a uma Category
     * Exemplo: Vestidos → pertence a → Roupas
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Subcategory PERTENCE a um Segment
     * Exemplo: Vestidos → pertence a → Mulher
     */
    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }

    /**
     * Subcategory tem MUITOS produtos
     * Exemplo: Vestidos → Vestido Floral, Vestido Preto...
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Subcategory tem MUITOS serviços
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
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

    /**
     * Filtrar por segmento
     * Uso: Subcategory::forSegment('mulher')->get()
     */
    public function scopeForSegment($query, $segmentSlug)
    {
        return $query->whereHas('segment', function ($q) use ($segmentSlug) {
            $q->where('slug', $segmentSlug);
        });
    }

    /**
     * Filtrar por categoria
     * Uso: Subcategory::forCategory('roupas')->get()
     */
    public function scopeForCategory($query, $categorySlug)
    {
        return $query->whereHas('category', function ($q) use ($categorySlug) {
            $q->where('slug', $categorySlug);
        });
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    /**
     * URL completa da subcategoria
     * Uso: $subcategory->url → "/mulher/roupas/vestidos"
     */
    public function getUrlAttribute(): string
    {
        return '/' . $this->segment->slug . '/' . $this->category->slug . '/' . $this->slug;
    }

    /**
     * Contagem de produtos ativos
     */
    public function getProductsCountAttribute(): int
    {
        return $this->products()->where('is_active', true)->count();
    }
}