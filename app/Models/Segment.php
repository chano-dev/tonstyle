<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Segment extends Model
{
    use HasFactory;

    /**
     * Campos permitidos para mass assignment
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'is_active',
        'display_order',
        'meta_title',
        'meta_description',
    ];

    /**
     * Casting de tipos
     */
    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    /**
     * Segment tem MUITAS subcategorias
     * Exemplo: Mulher → Vestidos, Blusas, Saias...
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    /**
     * Segment tem MUITOS serviços
     * Exemplo: Mulher → Aplicação de Peruca, Consultoria...
     */
    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    // ==========================================
    // SCOPES (Filtros reutilizáveis)
    // ==========================================

    /**
     * Filtrar apenas segmentos ativos
     * Uso: Segment::active()->get()
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Ordenar por display_order
     * Uso: Segment::ordered()->get()
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }

    // ==========================================
    // ACCESSORS (Atributos computados)
    // ==========================================

    /**
     * URL completa do segmento
     * Uso: $segment->url → "/mulher"
     */
    public function getUrlAttribute(): string
    {
        return '/' . $this->slug;
    }
}