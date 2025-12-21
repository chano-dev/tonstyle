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
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('segment_id')->constrained('segments')->onDelete('cascade');
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->text('description')->nullable();
            $table->string('image_path', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('display_order')->default(0);
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();

            $table->unique(['category_id', 'segment_id', 'slug']);
            $table->index(['is_active', 'display_order']); // Índice composto
        });

        
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();

            // Relationship
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Label
            $table->string('label', 50)->nullable()->comment('e.g., Casa, Trabalho, Mãe');

            // Recipient
            $table->string('recipient_name', 150)->nullable()->comment('Name of person receiving delivery');
            $table->string('recipient_phone', 20)->nullable();

            // Address Details
            $table->string('street', 255);
            $table->string('number', 20)->nullable();
            $table->string('complement', 100)->nullable()->comment('Apartment, block, etc.');
            $table->string('neighborhood', 100)->nullable()->comment('Bairro');
            $table->string('city', 100)->default('Luanda');
            $table->string('province', 100)->default('Luanda');
            $table->string('postal_code', 20)->nullable();
            $table->string('country', 100)->default('Angola');

            // Reference
            $table->text('landmark')->nullable()->comment('Reference point, e.g., Perto do Belas Shopping');

            // Control
            $table->boolean('is_default')->default(false)->comment('Only one address should be default per user');
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Indexes
            $table->index(['user_id', 'is_default']); // Buscar endereço padrão do user
            $table->index('neighborhood');             // Filtrar por bairro (mais usado em Luanda)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategories');
        Schema::dropIfExists('user_addresses');
    }
};
