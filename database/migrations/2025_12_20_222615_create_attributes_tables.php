<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    // ========================================
    // ATRIBUTOS UNIVERSAIS (6 tabelas)
    // ========================================

    // 1. COLORS - Cores para todos os produtos
    Schema::create('colors', function (Blueprint $table) {
        $table->id();
        $table->string('name', 50)->unique();
        $table->string('slug', 50)->unique();
        $table->string('hex_code', 7)->nullable()->comment('Código HEX: #FF5733');
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 2. SIZES - Tamanhos para roupas, calçados, acessórios
    Schema::create('sizes', function (Blueprint $table) {
        $table->id();
        $table->string('name', 20)->comment('XS, S, M, L, 35, 36, Único...');
        $table->string('slug', 20);
        $table->enum('size_type', ['clothing', 'footwear', 'accessories', 'universal'])->default('clothing');
        $table->string('description', 100)->nullable()->comment('Ex: Veste 36-38, Pulso 16-18cm');
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->unique(['slug', 'size_type']);
        $table->index(['is_active', 'size_type']);
    });

    // 3. MATERIALS - Materiais/tecidos para todos os produtos
    Schema::create('materials', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->enum('material_type', ['fabric', 'metal', 'plastic', 'leather', 'glass', 'wood', 'ceramic', 'synthetic', 'natural', 'mixed'])->default('fabric');
        $table->boolean('is_natural')->default(false)->comment('Material natural vs sintético');
        $table->enum('care_level', ['easy', 'moderate', 'delicate'])->default('moderate');
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index(['is_active', 'material_type']);
    });

    // 4. OCCASIONS - Ocasiões de uso
    Schema::create('occasions', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->string('icon', 100)->nullable()->comment('Font Awesome icon');
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 5. STYLES - Estilos visuais
    Schema::create('styles', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 6. PATTERNS - Padrões/estampas
    Schema::create('patterns', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // ========================================
    // ATRIBUTOS DE ROUPAS (4 tabelas)
    // ========================================

    // 7. FITS - Modelagem/corte
    Schema::create('fits', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 8. LENGTHS - Comprimentos
    Schema::create('lengths', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 9. NECKLINES - Decotes
    Schema::create('necklines', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 10. SLEEVES - Tipos de manga
    Schema::create('sleeves', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // ========================================
    // ATRIBUTOS DE CALÇADOS E ACESSÓRIOS (2 tabelas)
    // ========================================

    // 11. HEEL_TYPES - Tipos de salto
    Schema::create('heel_types', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->string('height_range', 50)->nullable()->comment('Ex: 5-8cm, 10-12cm');
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 12. CLOSURES - Fechos (calçados, bolsas, acessórios)
    Schema::create('closures', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // ========================================
    // DIFERENCIAIS ⭐ (3 tabelas)
    // ========================================

    // 13. BODY_TYPES - Tipos de corpo (DIFERENCIAL COMPETITIVO!)
    Schema::create('body_types', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->text('characteristics')->nullable()->comment('Características físicas deste tipo');
        $table->text('tips')->nullable()->comment('Dicas de estilo para este tipo de corpo');
        $table->string('image_path', 255)->nullable()->comment('Ilustração do tipo de corpo');
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 14. CARE_INSTRUCTIONS - Instruções de cuidado (roupas + cosméticos)
    Schema::create('care_instructions', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->string('icon', 100)->nullable()->comment('Ícone do símbolo de cuidado');
        $table->enum('instruction_type', ['washing', 'drying', 'ironing', 'storage', 'usage', 'expiry', 'other'])->default('other');
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index(['is_active', 'instruction_type']);
    });

    // 15. CERTIFICATIONS - Certificações/selos (roupas + cosméticos)
    Schema::create('certifications', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->string('icon', 100)->nullable();
        $table->string('logo_path', 255)->nullable()->comment('Logo da certificação');
        $table->enum('certification_type', ['eco', 'animal', 'health', 'quality', 'origin', 'other'])->default('other');
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index(['is_active', 'certification_type']);
    });

    // ========================================
    // ATRIBUTOS DE PERUCAS (5 tabelas)
    // ========================================

    // 16. HAIR_TYPES - Tipos de cabelo
    Schema::create('hair_types', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->text('characteristics')->nullable()->comment('Características do tipo');
        $table->string('durability', 50)->nullable()->comment('Ex: 1-2 anos, 6 meses');
        $table->enum('price_range', ['budget', 'mid', 'premium', 'luxury'])->default('mid');
        $table->boolean('can_be_dyed')->default(false);
        $table->boolean('can_be_heat_styled')->default(false);
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 17. HAIR_TEXTURES - Texturas de cabelo
    Schema::create('hair_textures', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->string('curl_pattern', 10)->nullable()->comment('Padrão: 1A, 1B, 2A, 2B, 3A, 3B, 3C, 4A, 4B, 4C');
        $table->text('styling_tips')->nullable();
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 18. CAP_TYPES - Tipos de touca/cap
    Schema::create('cap_types', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->text('description')->nullable();
        $table->text('characteristics')->nullable();
        $table->text('pros')->nullable()->comment('Vantagens');
        $table->text('cons')->nullable()->comment('Desvantagens');
        $table->enum('naturalness_level', ['low', 'medium', 'high', 'very_high'])->default('medium');
        $table->enum('ease_of_use', ['beginner', 'intermediate', 'advanced'])->default('intermediate');
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 19. HAIR_DENSITIES - Densidades de cabelo
    Schema::create('hair_densities', function (Blueprint $table) {
        $table->id();
        $table->string('name', 50)->unique()->comment('Ex: Leve, Natural, Cheio');
        $table->string('slug', 50)->unique();
        $table->unsignedInteger('percentage')->comment('Ex: 100, 130, 150, 180, 200');
        $table->text('description')->nullable();
        $table->enum('volume_level', ['light', 'natural', 'full', 'extra_full'])->default('natural');
        $table->text('recommended_for')->nullable()->comment('Para quem é recomendado');
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });

    // 20. HAIR_ORIGINS - Origens do cabelo
    Schema::create('hair_origins', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100)->unique();
        $table->string('slug', 100)->unique();
        $table->string('country_code', 3)->nullable()->comment('Código ISO: BR, PE, IN...');
        $table->text('description')->nullable();
        $table->text('characteristics')->nullable();
        $table->string('texture_profile', 100)->nullable()->comment('Ex: Naturalmente liso, ondulado');
        $table->enum('quality_tier', ['standard', 'premium', 'luxury'])->default('premium');
        $table->enum('price_range', ['budget', 'mid', 'premium', 'luxury'])->default('mid');
        $table->boolean('is_active')->default(true);
        $table->unsignedInteger('display_order')->default(0);
        $table->timestamps();

        $table->index('is_active');
    });
}

    /**
     * Reverse the migrations.
     */
public function down(): void
{
    // Drop in reverse order
    Schema::dropIfExists('hair_origins');
    Schema::dropIfExists('hair_densities');
    Schema::dropIfExists('cap_types');
    Schema::dropIfExists('hair_textures');
    Schema::dropIfExists('hair_types');
    Schema::dropIfExists('certifications');
    Schema::dropIfExists('care_instructions');
    Schema::dropIfExists('body_types'); //
    Schema::dropIfExists('closures'); //
    Schema::dropIfExists('heel_types'); //
    Schema::dropIfExists('sleeves'); //
    Schema::dropIfExists('necklines');
    Schema::dropIfExists('lengths'); //
    Schema::dropIfExists('fits'); //
    Schema::dropIfExists('patterns');//
    Schema::dropIfExists('styles'); //
    Schema::dropIfExists('occasions'); // 
    Schema::dropIfExists('materials'); //
    Schema::dropIfExists('sizes'); //
    Schema::dropIfExists('colors');
}
};

