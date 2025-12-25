<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'sku_code',
        'tax_id',
        'email',
        'phone',
        'whatsapp',
        'address',
        'city',
        'province',
        'country',
        'payment_terms',
        'payment_terms_notes',
        'credit_limit',
        'bank_name',
        'bank_account',
        'iban',
        'is_active',
        'is_consignment',
        'commission_percentage',
        'rating',
        'notes',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_consignment' => 'boolean',
        'commission_percentage' => 'decimal:2',
        'credit_limit' => 'decimal:2',
        'rating' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS
    // ==========================================

    /**
     * Supplier tem MUITOS produtos (via pivot)
     * Relação many-to-many com dados extra (preço, comissão)
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_suppliers')
                    ->withPivot(['cost_price', 'commission_percentage', 'is_preferred', 'is_active'])
                    ->withTimestamps();
    }

    /**
     * Relação direta com product_suppliers
     */
    public function productSuppliers(): HasMany
    {
        return $this->hasMany(ProductSupplier::class);
    }

    // ==========================================
    // SCOPES
    // ==========================================

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Apenas fornecedores de consignação
     */
    public function scopeConsignment($query)
    {
        return $query->where('is_consignment', true);
    }

    /**
     * Apenas fornecedor próprio (Teu Estilo)
     */
    public function scopeOwn($query)
    {
        return $query->where('is_consignment', false);
    }

    // ==========================================
    // ACCESSORS
    // ==========================================

    /**
     * Link direto para WhatsApp
     * Uso: $supplier->whatsapp_link
     */
    public function getWhatsappLinkAttribute(): ?string
    {
        if (!$this->whatsapp) {
            return null;
        }
        
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp);
        return "https://wa.me/244{$number}";
    }

    /**
     * Nome de exibição (company_name ou name)
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->company_name ?: $this->name;
    }

    /**
     * Contagem de produtos ativos
     */
    public function getProductsCountAttribute(): int
    {
        return $this->products()->wherePivot('is_active', true)->count();
    }
}