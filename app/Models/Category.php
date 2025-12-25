<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
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
     * Category tem MUITAS subcategorias
     * Exemplo: Roupas → Vestidos, Blusas, Calças...
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
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

    /**
     * URL da imagem com fallback
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path 
            ? asset('storage/' . $this->image_path)
            : null;
    }
}