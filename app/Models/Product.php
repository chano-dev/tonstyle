<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sku',
        'name',
        'slug',
        'description',
        'short_description',
        'subcategory_id',
        'brand_id',
        'collection_id',
        'price_cost',
        'price_sell',
        'discount_percentage',
        'weight',
        'condition',
        'is_active',
        'is_featured',
        'is_new',
        'is_trending',
        'is_bestseller',
        'is_on_sale',
        'publish_start',
        'publish_end',
        'meta_title',
        'meta_description',
        'views_count',
        'sales_count',
    ];

    protected $casts = [
        'price_cost' => 'decimal:2',
        'price_sell' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'weight' => 'integer',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_new' => 'boolean',
        'is_trending' => 'boolean',
        'is_bestseller' => 'boolean',
        'is_on_sale' => 'boolean',
        'publish_start' => 'date',
        'publish_end' => 'date',
        'views_count' => 'integer',
        'sales_count' => 'integer',
    ];

    // ==========================================
    // RELACIONAMENTOS DIRETOS (BelongsTo)
    // ==========================================

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    // ==========================================
    // RELACIONAMENTOS (HasMany)
    // ==========================================

    /**
     * Variações do produto (cor + tamanho + stock)
     */
    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * Imagens do produto
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Relação com fornecedores (com dados pivot)
     */
    public function productSuppliers(): HasMany
    {
        return $this->hasMany(ProductSupplier::class);
    }

    // ==========================================
    // RELACIONAMENTOS MANY-TO-MANY
    // ==========================================

    /**
     * Fornecedores do produto
     */
    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, 'product_suppliers')
                    ->withPivot(['cost_price', 'commission_percentage', 'is_preferred', 'is_active'])
                    ->withTimestamps();
    }

    /**
     * Cores do produto
     */
    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'product_colors')
                    ->withTimestamps();
    }

    /**
     * Tamanhos do produto
     */
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'product_sizes')
                    ->withTimestamps();
    }

    /**
     * Materiais/Tecidos do produto
     */
    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class, 'product_materials')
                    ->withPivot(['percentage', 'is_primary'])
                    ->withTimestamps();
    }

    /**
     * Ocasiões de uso
     */
    public function occasions(): BelongsToMany
    {
        return $this->belongsToMany(Occasion::class, 'product_occasions')
                    ->withTimestamps();
    }

    /**
     * Estilos visuais
     */
    public function styles(): BelongsToMany
    {
        return $this->belongsToMany(Style::class, 'product_styles')
                    ->withTimestamps();
    }

    /**
     * Padrões/Estampas
     */
    public function patterns(): BelongsToMany
    {
        return $this->belongsToMany(Pattern::class, 'product_patterns')
                    ->withTimestamps();
    }

    /**
     * Modelagens/Fits
     */
    public function fits(): BelongsToMany
    {
        return $this->belongsToMany(Fit::class, 'product_fits')
                    ->withTimestamps();
    }

    /**
     * Comprimentos
     */
    public function lengths(): BelongsToMany
    {
        return $this->belongsToMany(Length::class, 'product_lengths')
                    ->withTimestamps();
    }

    /**
     * Decotes
     */
    public function necklines(): BelongsToMany
    {
        return $this->belongsToMany(Neckline::class, 'product_necklines')
                    ->withTimestamps();
    }

    /**
     * Tipos de manga
     */
    public function sleeves(): BelongsToMany
    {
        return $this->belongsToMany(Sleeve::class, 'product_sleeves')
                    ->withTimestamps();
    }

    /**
     * Tipos de salto (calçados)
     */
    public function heelTypes(): BelongsToMany
    {
        return $this->belongsToMany(HeelType::class, 'product_heel_types')
                    ->withTimestamps();
    }

    /**
     * Tipos de fecho
     */
    public function closures(): BelongsToMany
    {
        return $this->belongsToMany(Closure::class, 'product_closures')
                    ->withTimestamps();
    }

    /**
     * ⭐ Tipos de corpo (DIFERENCIAL!)
     */
    public function bodyTypes(): BelongsToMany
    {
        return $this->belongsToMany(BodyType::class, 'product_body_types')
                    ->withPivot('recommendation_level')
                    ->withTimestamps();
    }

    /**
     * Instruções de cuidado
     */
    public function careInstructions(): BelongsToMany
    {
        return $this->belongsToMany(CareInstruction::class, 'product_care_instructions')
                    ->withPivot('display_order')
                    ->withTimestamps();
    }

    /**
     * Certificações
     */
    public function certifications(): BelongsToMany
    {
        return $this->belongsToMany(Certification::class, 'product_certifications')
                    ->withPivot(['certified_date', 'expiry_date'])
                    ->withTimestamps();
    }

    /**
     * Serviços associados ao produto
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'product_services')
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

    public function scopeOnSale($query)
    {
        return $query->where('is_on_sale', true)
                     ->where('discount_percentage', '>', 0);
    }

    public function scopeNew($query)
    {
        return $query->where('is_new', true);
    }

    public function scopeTrending($query)
    {
        return $query->where('is_trending', true);
    }

    public function scopeBestseller($query)
    {
        return $query->where('is_bestseller', true);
    }

    /**
     * Produtos publicados (dentro do período)
     */
    public function scopePublished($query)
    {
        $today = now()->toDateString();
        
        return $query->where('is_active', true)
                     ->where(function ($q) use ($today) {
                         $q->whereNull('publish_start')
                           ->orWhere('publish_start', '<=', $today);
                     })
                     ->where(function ($q) use ($today) {
                         $q->whereNull('publish_end')
                           ->orWhere('publish_end', '>=', $today);
                     });
    }

    /**
     * Filtrar por subcategoria
     */
    public function scopeInSubcategory($query, $subcategoryId)
    {
        return $query->where('subcategory_id', $subcategoryId);
    }

    /**
     * Filtrar por faixa de preço
     */
    public function scopePriceBetween($query, $min, $max)
    {
        return $query->whereBetween('price_sell', [$min, $max]);
    }

    /**
     * Filtrar por condição
     */
    public function scopeCondition($query, $condition)
    {
        return $query->where('condition', $condition);
    }

    /**
     * Com stock disponível
     */
    public function scopeInStock($query)
    {
        return $query->whereHas('variations', function ($q) {
            $q->where('stock_quantity', '>', 0)
              ->where('is_active', true);
        });
    }

    /**
     * ⭐ Filtrar por tipo de corpo
     */
    public function scopeForBodyType($query, $bodyTypeId)
    {
        return $query->whereHas('bodyTypes', function ($q) use ($bodyTypeId) {
            $q->where('body_type_id', $bodyTypeId);
        });
    }

    // ==========================================
    // ACCESSORS (Atributos Computados)
    // ==========================================

    /**
     * Preço final com desconto
     * Uso: $product->final_price
     */
    public function getFinalPriceAttribute(): float
    {
        if ($this->discount_percentage > 0) {
            return round($this->price_sell * (1 - $this->discount_percentage / 100), 2);
        }
        return $this->price_sell;
    }

    /**
     * Valor do desconto em Kwanzas
     */
    public function getDiscountAmountAttribute(): float
    {
        return round($this->price_sell - $this->final_price, 2);
    }

    /**
     * Stock total (soma de todas as variações)
     */
    public function getTotalStockAttribute(): int
    {
        return $this->variations()->sum('stock_quantity');
    }

    /**
     * Stock disponível (total - reservado)
     */
    public function getAvailableStockAttribute(): int
    {
        return $this->variations()->sum('stock_quantity') 
             - $this->variations()->sum('stock_reserved');
    }

    /**
     * Verifica se tem stock
     */
    public function getInStockAttribute(): bool
    {
        return $this->available_stock > 0;
    }

    /**
     * Imagem principal do produto
     */
    public function getPrimaryImageAttribute(): ?ProductImage
    {
        return $this->images()->where('is_primary', true)->first()
            ?? $this->images()->first();
    }

    /**
     * URL da imagem principal
     */
    public function getPrimaryImageUrlAttribute(): ?string
    {
        $image = $this->primary_image;
        return $image ? asset('storage/' . $image->file_path) : null;
    }

    /**
     * URL do produto
     */
    public function getUrlAttribute(): string
    {
        return route('products.show', $this->slug);
    }

    /**
     * Fornecedor preferido
     */
    public function getPreferredSupplierAttribute(): ?Supplier
    {
        return $this->suppliers()->wherePivot('is_preferred', true)->first()
            ?? $this->suppliers()->first();
    }

    /**
     * Composição de materiais formatada
     * Exemplo: "80% Algodão, 20% Poliéster"
     */
    public function getMaterialsCompositionAttribute(): string
    {
        return $this->materials
            ->map(fn($m) => ($m->pivot->percentage ? $m->pivot->percentage . '% ' : '') . $m->name)
            ->implode(', ');
    }

    // ==========================================
    // MÉTODOS
    // ==========================================

    /**
     * Incrementar visualizações
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }

    /**
     * Incrementar vendas
     */
    public function incrementSales(int $quantity = 1): void
    {
        $this->increment('sales_count', $quantity);
    }

    /**
     * Gerar SKU automaticamente
     */
    public static function generateSku(int $subcategoryId, int $supplierId): string
    {
        $subcategory = Subcategory::find($subcategoryId);
        $supplier = Supplier::find($supplierId);

        if (!$subcategory || !$supplier) {
            throw new \Exception('Subcategory ou Supplier não encontrado');
        }

        $prefix = $subcategory->sku_code . '-' . $supplier->sku_code;
        
        // Contar quantos produtos já existem com este prefixo
        $count = self::where('sku', 'like', $prefix . '-%')->count();
        
        return $prefix . '-' . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
    }
}