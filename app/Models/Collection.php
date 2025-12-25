<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'year',
        'season',
        'launch_date',
        'end_date',
        'image_path',
        'is_active',
        'is_featured',
        'display_order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'year' => 'integer',
        'launch_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'display_order' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    /**
     * Collection tem MUITOS produtos
     * Exemplo: Verão 2025 → Vestido Praia, Biquíni...
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

    /**
     * Coleções atualmente em vigor
     * Uso: Collection::current()->get()
     */
    public function scopeCurrent($query)
    {
        $today = now();
        return $query->where('is_active', true)
                     ->where(function ($q) use ($today) {
                         $q->whereNull('launch_date')
                           ->orWhere('launch_date', '<=', $today);
                     })
                     ->where(function ($q) use ($today) {
                         $q->whereNull('end_date')
                           ->orWhere('end_date', '>=', $today);
                     });
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path 
            ? asset('storage/' . $this->image_path)
            : null;
    }

    /**
     * Nome formatado com ano
     * Uso: $collection->full_name → "Verão 2025"
     */
    public function getFullNameAttribute(): string
    {
        return $this->name . ($this->year ? ' ' . $this->year : '');
    }

    /**
     * Verifica se a coleção está em vigor
     */
    public function getIsCurrentAttribute(): bool
    {
        $today = now();
        $afterLaunch = !$this->launch_date || $this->launch_date <= $today;
        $beforeEnd = !$this->end_date || $this->end_date >= $today;
        
        return $this->is_active && $afterLaunch && $beforeEnd;
    }
}