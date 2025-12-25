<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Tabelas núcleo do e-commerce: products e services
     */
    public function up(): void
    {
        // ========================================
        // TABELA: PRODUCTS
        // ========================================
        // Armazena produtos físicos (roupas, calçados, acessórios, cosméticos)
        // O stock real fica em product_variations (por cor + tamanho)
        // SKU formato: [SUBCATEGORY_CODE]-[SUPPLIER_CODE]-[SEQUENCE]
        // Exemplo: DRESS-CKEU-0001

        Schema::create('products', function (Blueprint $table) {
            // === IDENTIDADE ===
            $table->id();
            $table->string('sku', 50)->unique()->comment('Código único: DRESS-CKEU-0001');
            $table->string('name', 200);
            $table->string('slug', 200)->unique();

            // === DESCRIÇÃO ===
            $table->text('description')->nullable()->comment('Descrição completa, pode ter HTML');
            $table->string('short_description', 500)->nullable()->comment('Resumo para cards e listagens');

            // === CLASSIFICAÇÃO (Foreign Keys) ===
            $table->foreignId('subcategory_id')->constrained('subcategories')->onDelete('restrict');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
            $table->foreignId('collection_id')->nullable()->constrained('collections')->onDelete('set null');

            // === PREÇOS ===
            $table->decimal('price_cost', 10, 2)->nullable()->comment('Preço de custo (quanto pagaste)');
            $table->decimal('price_sell', 10, 2)->comment('Preço de venda ao cliente');
            $table->decimal('discount_percentage', 5, 2)->default(0)->comment('Desconto em %');

            // === FÍSICO ===
            $table->unsignedInteger('weight')->nullable()->comment('Peso em gramas (para frete)');

            // === CONDIÇÃO ===
            $table->enum('condition', ['new', 'used', 'semi_new'])->default('new')->comment('Estado do produto');

            // === FLAGS DE DESTAQUE ===
            $table->boolean('is_active')->default(true)->comment('Visível no site?');
            $table->boolean('is_featured')->default(false)->comment('Destaque na homepage?');
            $table->boolean('is_new')->default(false)->comment('Badge Novo?');
            $table->boolean('is_trending')->default(false)->comment('Badge Em Alta?');
            $table->boolean('is_bestseller')->default(false)->comment('Badge Mais Vendido?');
            $table->boolean('is_on_sale')->default(false)->comment('Em promoção? (auto se discount > 0)');

            // === AGENDAMENTO ===
            $table->date('publish_start')->nullable()->comment('Início da visibilidade');
            $table->date('publish_end')->nullable()->comment('Fim da visibilidade');

            // === SEO ===
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();

            // === ANALYTICS ===
            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('sales_count')->default(0);

            // === CONTROLO ===
            $table->timestamps();
            $table->softDeletes(); // deleted_at

            // === ÍNDICES ===
            $table->index('subcategory_id');
            $table->index('brand_id');
            $table->index('collection_id');
            $table->index('condition');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('is_on_sale');
            $table->index(['is_active', 'is_featured']); // Produtos ativos em destaque
            $table->index(['publish_start', 'publish_end']); // Agendamento
        });


        // ========================================
        // TABELA: SERVICES
        // ========================================
        // Armazena serviços premium (aluguer, costura, aplicação de perucas, consultoria)
        // Agendamento via WhatsApp (simplificado)

        Schema::create('services', function (Blueprint $table) {
            // === IDENTIDADE ===
            $table->id();
            $table->string('name', 200);
            $table->string('slug', 200)->unique();

            // === DESCRIÇÃO ===
            $table->text('description')->nullable();
            $table->string('short_description', 500)->nullable();

            // === CLASSIFICAÇÃO ===
            $table->foreignId('subcategory_id')->constrained('subcategories')->onDelete('restrict');
            $table->foreignId('segment_id')->nullable()->constrained('segments')->onDelete('set null')
                  ->comment('NULL = serviço universal (todos os segmentos)');

            // === PREÇOS ===
            $table->decimal('base_price', 10, 2)->comment('Preço base do serviço');
            $table->enum('price_type', ['fixed', 'per_hour', 'per_day', 'variable', 'custom'])
                  ->default('fixed')
                  ->comment('fixed=fixo, per_hour=por hora, per_day=por dia (aluguer), variable=depende, custom=orçamento');

            // === REQUISITOS ===
            $table->boolean('requires_measurements')->default(false)->comment('Precisa de medidas? (costura)');
            $table->boolean('requires_deposit')->default(false)->comment('Exige sinal/depósito? (aluguer)');
            $table->decimal('deposit_percentage', 5, 2)->nullable()->comment('% do depósito (ex: 50.00 = 50%)');

            // === DURAÇÃO ===
            $table->unsignedInteger('duration_minutes')->nullable()->comment('Duração estimada em minutos');

            // === MEDIA ===
            $table->string('image_path', 255)->nullable()->comment('Imagem principal do serviço');

            // === FLAGS ===
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('display_order')->default(0);

            // === SEO ===
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();

            // === CONTROLO ===
            $table->timestamps();
            $table->softDeletes();

            // === ÍNDICES ===
            $table->index('subcategory_id');
            $table->index('segment_id');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index(['is_active', 'display_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
        Schema::dropIfExists('products');
    }
};