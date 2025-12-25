<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabelas de relacionamento para products e services
     */
    public function up(): void
    {
        // ========================================
        // TABELA: PRODUCT_SUPPLIERS
        // ========================================
        // Liga produtos a fornecedores (many-to-many com dados extra)
        // Um produto pode ter MÚLTIPLOS fornecedores com preços diferentes
        // Exemplo: Vestido X → Fornecedor A (8.000 Kz) + Fornecedor B (7.500 Kz)

        Schema::create('product_suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            
            // Preço e comissão específicos deste fornecedor para este produto
            $table->decimal('cost_price', 10, 2)->nullable()->comment('Preço de custo deste fornecedor');
            $table->decimal('commission_percentage', 5, 2)->nullable()->comment('Comissão negociada (consignação)');
            
            // Gestão
            $table->boolean('is_preferred')->default(false)->comment('Fornecedor preferido para este produto?');
            $table->unsignedInteger('lead_time_days')->nullable()->comment('Prazo de entrega em dias');
            $table->unsignedInteger('min_order_quantity')->nullable()->comment('Quantidade mínima de encomenda');
            $table->boolean('is_active')->default(true);
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Índices
            $table->unique(['product_id', 'supplier_id']);
            $table->index('is_preferred');
            $table->index('is_active');
        });


        // ========================================
        // TABELA: PRODUCT_VARIATIONS
        // ========================================
        // Variações de cor + tamanho com STOCK INDIVIDUAL
        // O stock real do e-commerce vive AQUI, não em products!
        // Exemplo: Vestido Vermelho M = 5 unidades, Vestido Vermelho L = 3 unidades

        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('color_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('size_id')->nullable()->constrained()->onDelete('set null');
            
            // SKU da variação (gerado: SKU_PRODUTO-COR-TAMANHO)
            // Exemplo: DRESS-CKEU-0001-RED-M
            $table->string('sku_variation', 80)->unique()->comment('SKU único desta variação');
            
            // Preço ajustado (ex: +500 Kz para tamanhos grandes)
            $table->decimal('price_adjustment', 10, 2)->default(0)->comment('Ajuste de preço (+/-)');
            
            // STOCK - O coração do e-commerce!
            $table->unsignedInteger('stock_quantity')->default(0)->comment('Stock total disponível');
            $table->unsignedInteger('stock_reserved')->default(0)->comment('Stock reservado em carrinhos');
            $table->unsignedInteger('stock_min')->default(0)->comment('Alerta de stock mínimo');
            
            // Imagem específica desta cor (opcional)
            $table->string('image_path', 255)->nullable()->comment('Imagem desta variação de cor');
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Índices
            $table->unique(['product_id', 'color_id', 'size_id'], 'product_color_size_unique');
            $table->index('stock_quantity');
            $table->index('is_active');
        });


        // ========================================
        // TABELA: PRODUCT_IMAGES
        // ========================================
        // Galeria de fotos dos produtos
        // Convenção de pastas: /storage/products/{product_id}/{tipo}.webp
        // Tipos: main, front, back, side, detail, model, flat, lifestyle

        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            // Pode estar associada a uma variação específica (cor)
            $table->foreignId('variation_id')->nullable()
                  ->constrained('product_variations')->onDelete('set null')
                  ->comment('Se preenchido, imagem é específica desta variação de cor');
            
            // Ficheiro
            $table->string('file_path', 255)->comment('Caminho: products/{id}/main.webp');
            $table->string('file_name', 255)->comment('Nome original do ficheiro');
            $table->unsignedInteger('file_size')->nullable()->comment('Tamanho em bytes');
            
            // Tipo e organização
            $table->enum('image_type', [
                'main',      // Imagem principal (listagens)
                'front',     // Frente
                'back',      // Costas
                'side',      // Lateral
                'detail',    // Detalhe (textura, botões, etc.)
                'model',     // Com modelo vestindo
                'flat',      // Flat lay (produto deitado)
                'lifestyle'  // Estilo de vida / ambiente
            ])->default('main');
            
            $table->boolean('is_primary')->default(false)->comment('Imagem principal do produto?');
            $table->unsignedInteger('display_order')->default(0);
            
            // SEO / Acessibilidade
            $table->string('alt_text', 255)->nullable()->comment('Texto alternativo para SEO');
            
            $table->timestamps();
            
            // Índices
            $table->index('product_id');
            $table->index('variation_id');
            $table->index('is_primary');
            $table->index('display_order');
        });


        // ========================================
        // TABELA: PRODUCT_SERVICES
        // ========================================
        // Liga produtos a serviços opcionais
        // Exemplo: Vestido de Noiva → Serviço de Ajustes (+5.000 Kz)
        // Exemplo: Peruca Lace Front → Aplicação Profissional (+15.000 Kz)

        Schema::create('product_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            
            // Preço e inclusão
            $table->boolean('is_included')->default(false)->comment('Serviço já incluído no preço do produto?');
            $table->decimal('additional_price', 10, 2)->nullable()->comment('Preço adicional se não incluído');
            $table->decimal('discount_percentage', 5, 2)->nullable()->comment('Desconto bundle (comprar junto)');
            
            // Obrigatoriedade
            $table->boolean('is_required')->default(false)->comment('Obrigatório comprar com o produto?');
            $table->boolean('is_recommended')->default(true)->comment('Mostrar como sugestão?');
            
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // Índices
            $table->unique(['product_id', 'service_id']);
            $table->index('is_recommended');
            $table->index('is_active');
        });


        // ========================================
        // TABELA: SERVICE_IMAGES
        // ========================================
        // Portfolio e galeria dos serviços
        // Antes/Depois, exemplos de trabalho, processo
        // Convenção: /storage/services/{service_id}/{tipo}_{n}.webp

        Schema::create('service_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            
            // Ficheiro
            $table->string('file_path', 255)->comment('Caminho: services/{id}/portfolio_1.webp');
            $table->string('file_name', 255);
            $table->unsignedInteger('file_size')->nullable();
            
            // Tipo
            $table->enum('image_type', [
                'main',       // Imagem principal
                'portfolio',  // Trabalho realizado
                'before',     // Antes (transformação)
                'after',      // Depois (transformação)
                'process',    // Durante o processo
                'result'      // Resultado final
            ])->default('portfolio');
            
            // Informação extra (opcional)
            $table->string('caption', 255)->nullable()->comment('Legenda da imagem');
            $table->date('work_date')->nullable()->comment('Data do trabalho');
            
            $table->boolean('is_featured')->default(false)->comment('Destaque no portfolio?');
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
            
            // Índices
            $table->index('service_id');
            $table->index('is_featured');
            $table->index('display_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_images');
        Schema::dropIfExists('product_services');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('product_variations');
        Schema::dropIfExists('product_suppliers');
    }
};