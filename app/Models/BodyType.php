<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BodyType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'characteristics',
        'tips',
        'image_path',
        'icon',
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
        return $this->belongsToMany(Product::class, 'product_body_types')
                    ->withPivot('recommendation_level')
                    ->withTimestamps();
    }

    public function highlyRecommendedProducts(): BelongsToMany
    {
        return $this->products()->wherePivot('recommendation_level', 'highly_recommended');
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

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? asset('storage/' . $this->image_path) : null;
    }

    public function getProductsCountAttribute(): int
    {
        return $this->products()->where('is_active', true)->count();
    }

    public function getTipsArrayAttribute(): array
    {
        if (!$this->tips) return [];
        return array_map('trim', explode("\n", $this->tips));
    }
}