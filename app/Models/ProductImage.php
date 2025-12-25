<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'variation_id',
        'file_path',
        'file_name',
        'file_size',
        'image_type',
        'is_primary',
        'display_order',
        'alt_text',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'is_primary' => 'boolean',
        'display_order' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variation(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class, 'variation_id');
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('image_type', $type);
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Tamanho formatado
     * Exemplo: "1.5 MB"
     */
    public function getFileSizeFormattedAttribute(): string
    {
        if (!$this->file_size) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->file_size;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }

    /**
     * Tipo de imagem traduzido
     */
    public function getImageTypeLabelAttribute(): string
    {
        return match($this->image_type) {
            'main' => 'Principal',
            'front' => 'Frente',
            'back' => 'Costas',
            'side' => 'Lateral',
            'detail' => 'Detalhe',
            'model' => 'Com Modelo',
            'flat' => 'Flat Lay',
            'lifestyle' => 'Lifestyle',
            default => $this->image_type,
        };
    }
}