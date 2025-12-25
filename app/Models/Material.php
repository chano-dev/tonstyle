<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'material_type',
        'is_natural',
        'care_level',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_natural' => 'boolean',
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_materials')
                    ->withPivot(['percentage', 'is_primary'])
                    ->withTimestamps();
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

    public function scopeNatural($query)
    {
        return $query->where('is_natural', true);
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    public function getCareLevelLabelAttribute(): string
    {
        return match($this->care_level) {
            'easy' => 'Fácil',
            'moderate' => 'Moderado',
            'delicate' => 'Delicado',
            default => $this->care_level ?? 'Não especificado',
        };
    }
}