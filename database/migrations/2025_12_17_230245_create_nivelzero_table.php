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
        // Tabela dos Segmentos
        Schema::create('segments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->string('icon', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('display_order')->default(0);
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();

            $table->index('is_active');
            $table->index('slug');
        });

        // Tabela das Categorias
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();
            $table->string('icon', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('display_order')->default(0);
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();

            $table->index('is_active');
            $table->index('slug');
        });

        // Tabela dos Fornecedores 
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('name', 150);
            $table->string('company_name', 200)->nullable();
            $table->string('tax_id', 50)->nullable()->unique()->comment('NIF in Angola');

            // Contact
            $table->string('email', 150)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();

            // Address
            $table->text('address')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->nullable()->comment('Province in Angola');
            $table->string('country', 100)->default('Angola');

            // Financial
            $table->enum('payment_terms', ['cash', '7_days', '15_days', '30_days', '60_days', 'custom'])->default('cash');
            $table->text('payment_terms_notes')->nullable();
            $table->decimal('credit_limit', 12, 2)->nullable();

            // Bank Details
            $table->string('bank_name', 150)->nullable();
            $table->string('bank_account', 100)->nullable();
            $table->string('iban', 50)->nullable();

            // Organization
            $table->boolean('is_active')->default(true);
            $table->boolean('is_consignment')->default(false)->comment('TRUE = resale/consignment supplier');
            $table->decimal('commission_percentage', 5, 2)->nullable()->comment('Commission % for consignment');
            $table->unsignedTinyInteger('rating')->nullable()->comment('1-5 rating');
            $table->text('notes')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('is_active');
            $table->index('is_consignment');
            $table->index('name');
        });

        // Tabela das Marcas 
        Schema::create('brands', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('name', 100)->unique();
            $table->string('slug', 100)->unique();
            $table->text('description')->nullable();

            // Images
            $table->string('logo_path', 255)->nullable();
            $table->string('banner_path', 255)->nullable();

            // Origin
            $table->string('country_origin', 100)->nullable();

            // Organization
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('display_order')->default(0);

            // SEO
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['is_active', 'is_featured']);
            $table->index('slug');
        });

        // Tabela das Colecções 
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            
            // Basic Info
            $table->string('name', 150);
            $table->string('slug', 150)->unique();
            $table->text('description')->nullable();
            
            // Season
            $table->year('year');
            $table->enum('season', ['revellion', 'valentine', 'all_year', 'special', 'halloween', 'school', 'weeding', 'vacations', 'work'])->default('all_year');
            
            // Dates
            $table->date('launch_date')->nullable();
            $table->date('end_date')->nullable();
            
            // Image
            $table->string('image_path', 255)->nullable();
            
            // Organization
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('display_order')->default(0);
            
            // SEO
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index(['year', 'season']);
            $table->index(['is_active', 'is_featured']);
            $table->index(['launch_date', 'end_date']);
        });


        // Tabela dos Profissionais (para serviços: costureiras, consultoras, etc.)
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            
            // Relacionamento com user (opcional - profissional pode ter conta no site)
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            
            // Dados Pessoais
            $table->string('name', 150);
            $table->string('slug', 150)->unique();
            $table->string('email', 150)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            
            // Profissão/Especialidade
            $table->string('profession', 100)->comment('Ex: Costureira, Consultora de Estilo, Cabeleireira');
            $table->text('bio')->nullable()->comment('Biografia/descrição do profissional');
            $table->text('specialties')->nullable()->comment('Especialidades específicas');
            $table->unsignedInteger('experience_years')->nullable()->comment('Anos de experiência');
            
            // Imagens
            $table->string('photo_path', 255)->nullable()->comment('Foto do profissional');
            $table->string('cover_path', 255)->nullable()->comment('Imagem de capa/banner');
            
            // Localização
            $table->string('city', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->boolean('works_remotely')->default(false)->comment('Atende remotamente/online?');
            $table->boolean('works_on_site')->default(true)->comment('Atende presencialmente?');
            
            // Disponibilidade
            $table->json('available_days')->nullable()->comment('Dias disponíveis: ["monday", "tuesday", ...]');
            $table->json('available_hours')->nullable()->comment('Horários: {"start": "09:00", "end": "18:00"}');
            
            // Avaliação
            $table->decimal('rating', 3, 2)->nullable()->comment('Média de avaliação (1.00-5.00)');
            $table->unsignedInteger('reviews_count')->default(0)->comment('Número de avaliações');
            
            // Organização
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false)->comment('Profissional em destaque?');
            $table->boolean('is_verified')->default(false)->comment('Profissional verificado pela equipa?');
            $table->unsignedInteger('display_order')->default(0);
            
            // SEO
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_description')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('user_id');
            $table->index('profession');
            $table->index('is_active');
            $table->index('is_featured');
            $table->index('is_verified');
            $table->index(['city', 'province']);
            $table->index('slug');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('segments');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('professionals');
    }
};
