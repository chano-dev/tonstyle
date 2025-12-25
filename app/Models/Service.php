<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'subcategory_id',
        'segment_id',
        'base_price',
        'price_type',
        'requires_measurements',
        'requires_deposit',
        'deposit_percentage',
        'duration_minutes',
        'image_path',
        'is_active',
        'is_featured',
        'display_order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'base_price' => 'decimal:2',
        'deposit_percentage' => 'decimal:2',
        'duration_minutes' => 'integer',
        'requires_measurements' => 'boolean',
        'requires_deposit' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'display_order' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ServiceImage::class);
    }

    /**
     * Produtos que oferecem este serviço
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_services')
                    ->withPivot(['is_included', 'additional_price', 'discount_percentage', 'is_required', 'is_recommended'])
                    ->withTimestamps();
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
     * Serviços universais (sem segmento específico)
     */
    public function scopeUniversal($query)
    {
        return $query->whereNull('segment_id');
    }

    /**
     * Serviços de um segmento específico
     */
    public function scopeForSegment($query, $segmentId)
    {
        return $query->where(function ($q) use ($segmentId) {
            $q->where('segment_id', $segmentId)
              ->orWhereNull('segment_id'); // Inclui universais
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
     * Valor do depósito em Kwanzas
     */
    public function getDepositAmountAttribute(): float
    {
        if (!$this->requires_deposit || !$this->deposit_percentage) {
            return 0;
        }
        return round($this->base_price * $this->deposit_percentage / 100, 2);
    }

    /**
     * Duração formatada
     * Exemplo: "1h 30min"
     */
    public function getDurationFormattedAttribute(): ?string
    {
        if (!$this->duration_minutes) {
            return null;
        }

        $hours = floor($this->duration_minutes / 60);
        $minutes = $this->duration_minutes % 60;

        if ($hours > 0 && $minutes > 0) {
            return "{$hours}h {$minutes}min";
        } elseif ($hours > 0) {
            return "{$hours}h";
        } else {
            return "{$minutes}min";
        }
    }

    /**
     * Tipo de preço traduzido
     */
    public function getPriceTypeLabelAttribute(): string
    {
        return match($this->price_type) {
            'fixed' => 'Preço Fixo',
            'per_hour' => 'Por Hora',
            'per_day' => 'Por Dia',
            'variable' => 'Variável',
            'custom' => 'Sob Consulta',
            default => $this->price_type,
        };
    }
}