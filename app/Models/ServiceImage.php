<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'file_path',
        'file_name',
        'file_size',
        'image_type',
        'caption',
        'work_date',
        'is_featured',
        'display_order',
    ];

    protected $casts = [
        'file_size' => 'integer',
        'work_date' => 'date',
        'is_featured' => 'boolean',
        'display_order' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
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

    public function getImageTypeLabelAttribute(): string
    {
        return match($this->image_type) {
            'main' => 'Principal',
            'portfolio' => 'Portfolio',
            'before' => 'Antes',
            'after' => 'Depois',
            'process' => 'Processo',
            'result' => 'Resultado',
            default => $this->image_type,
        };
    }
}