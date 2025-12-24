<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adiciona coluna sku_code para geração automática de SKU nos produtos
     * Formato SKU: [SUBCATEGORY_CODE]-[SUPPLIER_CODE]-[SEQUENCE]
     * Exemplo: DRESS-CKEU-0001
     */
    public function up(): void
    {
        // Adicionar sku_code em subcategories
        Schema::table('subcategories', function (Blueprint $table) {
            $table->string('sku_code', 5)->nullable()->after('slug')->comment('Código para SKU: DRESS, BLOUS, SKIRT...');
            $table->index('sku_code');
        });

        // Adicionar sku_code em suppliers
        Schema::table('suppliers', function (Blueprint $table) {
            $table->string('sku_code', 4)->nullable()->after('name')->comment('Código 4 letras para SKU: CKEU, TEND, TEST...');
            $table->index('sku_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subcategories', function (Blueprint $table) {
            $table->dropIndex(['sku_code']);
            $table->dropColumn('sku_code');
        });

        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropIndex(['sku_code']);
            $table->dropColumn('sku_code');
        });
    }
};