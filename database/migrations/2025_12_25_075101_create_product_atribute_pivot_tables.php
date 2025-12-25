<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 15 Tabelas Pivot - Relacionamento Many-to-Many entre Products e Atributos
     * Um produto pode ter múltiplas cores, tamanhos, ocasiões, etc.
     */
    public function up(): void
    {
        // ========================================
        // GRUPO 1: ATRIBUTOS UNIVERSAIS (6 tabelas)
        // ========================================

        // 1. PRODUCT_COLORS
        // Cores disponíveis para o produto (filtro principal)
        Schema::create('product_colors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('color_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'color_id']);
            $table->index('color_id');
        });

        // 2. PRODUCT_SIZES
        // Tamanhos disponíveis para o produto (filtro principal)
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('size_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'size_id']);
            $table->index('size_id');
        });

        // 3. PRODUCT_MATERIALS
        // Composição do produto (ex: 80% Algodão, 20% Poliéster)
        Schema::create('product_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('material_id')->constrained()->onDelete('cascade');
            $table->decimal('percentage', 5, 2)->nullable()->comment('Percentagem na composição (ex: 80.00)');
            $table->boolean('is_primary')->default(false)->comment('Material principal?');
            $table->timestamps();

            $table->unique(['product_id', 'material_id']);
            $table->index('material_id');
        });

        // 4. PRODUCT_OCCASIONS
        // Ocasiões de uso (Festa, Trabalho, Casual, etc.)
        Schema::create('product_occasions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('occasion_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'occasion_id']);
            $table->index('occasion_id');
        });

        // 5. PRODUCT_STYLES
        // Estilos visuais (Elegante, Boémio, Casual, etc.)
        Schema::create('product_styles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('style_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'style_id']);
            $table->index('style_id');
        });

        // 6. PRODUCT_PATTERNS
        // Padrões/estampas (Floral, Listras, Liso, etc.)
        Schema::create('product_patterns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('pattern_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'pattern_id']);
            $table->index('pattern_id');
        });


        // ========================================
        // GRUPO 2: ATRIBUTOS DE ROUPAS (4 tabelas)
        // ========================================

        // 7. PRODUCT_FITS
        // Modelagem/corte (Slim, Regular, Oversized, etc.)
        Schema::create('product_fits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('fit_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'fit_id']);
            $table->index('fit_id');
        });

        // 8. PRODUCT_LENGTHS
        // Comprimentos (Mini, Midi, Longo, etc.)
        Schema::create('product_lengths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('length_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'length_id']);
            $table->index('length_id');
        });

        // 9. PRODUCT_NECKLINES
        // Tipos de decote (V, Redondo, Ombro a Ombro, etc.)
        Schema::create('product_necklines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('neckline_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'neckline_id']);
            $table->index('neckline_id');
        });

        // 10. PRODUCT_SLEEVES
        // Tipos de manga (Sem manga, Curta, Longa, etc.)
        Schema::create('product_sleeves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('sleeve_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'sleeve_id']);
            $table->index('sleeve_id');
        });


        // ========================================
        // GRUPO 3: ATRIBUTOS DE CALÇADOS (2 tabelas)
        // ========================================

        // 11. PRODUCT_HEEL_TYPES
        // Tipos de salto (Agulha, Grosso, Plataforma, etc.)
        Schema::create('product_heel_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('heel_type_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'heel_type_id']);
            $table->index('heel_type_id');
        });

        // 12. PRODUCT_CLOSURES
        // Tipos de fecho (Zíper, Botões, Elástico, etc.)
        Schema::create('product_closures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('closure_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['product_id', 'closure_id']);
            $table->index('closure_id');
        });


        // ========================================
        // GRUPO 4: ATRIBUTOS DIFERENCIAIS (3 tabelas)
        // ========================================

        // 13. PRODUCT_BODY_TYPES ⭐ DIFERENCIAL COMPETITIVO!
        // Recomendação por tipo de corpo (Ampulheta, Triângulo, etc.)
        // Campo extra: recommendation_level para indicar quão adequado é
        Schema::create('product_body_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('body_type_id')->constrained()->onDelete('cascade');
            $table->enum('recommendation_level', [
                'highly_recommended',  // Altamente recomendado - favorece muito
                'recommended',         // Recomendado - fica bem
                'suitable'             // Adequado - pode usar
            ])->default('suitable')->comment('Nível de recomendação para este tipo de corpo');
            $table->timestamps();

            $table->unique(['product_id', 'body_type_id']);
            $table->index('body_type_id');
            $table->index('recommendation_level');
        });

        // 14. PRODUCT_CARE_INSTRUCTIONS
        // Instruções de cuidado (Lavar à mão, Não passar, etc.)
        Schema::create('product_care_instructions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('care_instruction_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('display_order')->default(0)->comment('Ordem de exibição');
            $table->timestamps();

            $table->unique(['product_id', 'care_instruction_id'], 'product_care_unique');
            $table->index('care_instruction_id');
        });

        // 15. PRODUCT_CERTIFICATIONS
        // Certificações/selos (Orgânico, Vegan, Cruelty-free, etc.)
        Schema::create('product_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('certification_id')->constrained()->onDelete('cascade');
            $table->date('certified_date')->nullable()->comment('Data da certificação');
            $table->date('expiry_date')->nullable()->comment('Data de validade (se aplicável)');
            $table->timestamps();

            $table->unique(['product_id', 'certification_id']);
            $table->index('certification_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Apagar na ordem inversa
        Schema::dropIfExists('product_certifications');
        Schema::dropIfExists('product_care_instructions');
        Schema::dropIfExists('product_body_types');
        Schema::dropIfExists('product_closures');
        Schema::dropIfExists('product_heel_types');
        Schema::dropIfExists('product_sleeves');
        Schema::dropIfExists('product_necklines');
        Schema::dropIfExists('product_lengths');
        Schema::dropIfExists('product_fits');
        Schema::dropIfExists('product_patterns');
        Schema::dropIfExists('product_styles');
        Schema::dropIfExists('product_occasions');
        Schema::dropIfExists('product_materials');
        Schema::dropIfExists('product_sizes');
        Schema::dropIfExists('product_colors');
    }
};