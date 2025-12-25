<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Sistema de Carrinho - Suporta utilizadores logados E convidados
     * Integração com WhatsApp para finalização de compras
     */
    public function up(): void
    {
        // ========================================
        // TABELA 1: CARTS
        // ========================================
        // Carrinho de compras - suporta logados e convidados
        // Convidados identificados por session_id
        // Partilha via WhatsApp usando cart_token único

        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            
            // Identificação do dono do carrinho
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')
                  ->comment('NULL = convidado (usa session_id)');
            $table->string('session_id', 100)->nullable()->comment('Para convidados não logados');
            $table->string('cart_token', 64)->unique()->comment('Token único para partilha via WhatsApp');
            
            // Dados do convidado (se não logado)
            $table->string('guest_name', 100)->nullable();
            $table->string('guest_email', 100)->nullable();
            $table->string('guest_phone', 20)->nullable();
            
            // Endereço de entrega (pode ser do user_addresses ou manual)
            $table->foreignId('user_address_id')->nullable()->constrained()->onDelete('set null');
            $table->string('delivery_street', 255)->nullable();
            $table->string('delivery_number', 20)->nullable();
            $table->string('delivery_neighborhood', 100)->nullable();
            $table->string('delivery_city', 100)->nullable();
            $table->string('delivery_province', 100)->nullable();
            $table->text('delivery_landmark')->nullable()->comment('Ponto de referência');
            
            // Totais (calculados)
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            
            // Estado do carrinho
            $table->enum('status', [
                'active',     // Em uso
                'abandoned',  // Abandonado (sem atividade)
                'converted',  // Convertido em venda
                'expired'     // Expirado (tempo limite)
            ])->default('active');
            
            // Notas
            $table->text('customer_notes')->nullable()->comment('Notas do cliente');
            $table->text('internal_notes')->nullable()->comment('Notas internas (admin)');
            
            // Controlo de tempo
            $table->timestamp('expires_at')->nullable()->comment('Quando o carrinho expira');
            $table->timestamps();
            
            // Índices
            $table->index('user_id');
            $table->index('session_id');
            $table->index('status');
            $table->index('expires_at');
        });


        // ========================================
        // TABELA 2: CART_ITEMS
        // ========================================
        // Itens individuais no carrinho
        // Liga ao produto E à variação específica (cor+tamanho)

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('variation_id')->nullable()
                  ->constrained('product_variations')->onDelete('cascade')
                  ->comment('Variação específica: cor + tamanho');
            
            // Quantidade e preço
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('unit_price', 10, 2)->comment('Preço no momento de adicionar');
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->decimal('subtotal', 10, 2)->comment('quantity * unit_price - desconto');
            
            // Confirmação de stock (para consignação)
            $table->boolean('needs_confirmation')->default(false)
                  ->comment('Produto de consignação precisa confirmar stock?');
            $table->timestamp('confirmed_at')->nullable();
            $table->string('confirmed_by', 100)->nullable()->comment('Quem confirmou');
            
            // Notas do item
            $table->text('notes')->nullable()->comment('Observações específicas do item');
            
            $table->timestamps();
            
            // Índices
            $table->index('cart_id');
            $table->index('product_id');
            $table->index('variation_id');
            $table->index('needs_confirmation');
        });


        // ========================================
        // TABELA 3: WISHLIST
        // ========================================
        // Lista de desejos / Favoritos
        // Só para utilizadores logados

        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('variation_id')->nullable()
                  ->constrained('product_variations')->onDelete('set null')
                  ->comment('Variação preferida (opcional)');
            
            // Preferências de notificação
            $table->boolean('notify_on_sale')->default(false)->comment('Notificar quando entrar em promoção?');
            $table->boolean('notify_on_restock')->default(false)->comment('Notificar quando voltar ao stock?');
            
            // Prioridade pessoal
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->text('notes')->nullable()->comment('Notas pessoais');
            
            $table->timestamps();
            
            // Índices
            $table->unique(['user_id', 'product_id']);
            $table->index('notify_on_sale');
            $table->index('notify_on_restock');
        });


        // ========================================
        // TABELA 4: PRODUCT_VIEWS
        // ========================================
        // Analytics - Histórico de visualizações de produtos
        // Útil para: "Vistos recentemente", "Produtos populares"

        Schema::create('product_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade')
                  ->comment('NULL = visitante não logado');
            $table->string('session_id', 100)->nullable()->comment('Para visitantes');
            
            // Informação da visita
            $table->timestamp('viewed_at')->useCurrent();
            $table->string('source', 50)->nullable()
                  ->comment('Origem: search, category, recommendation, direct, whatsapp');
            
            // Device info (opcional, para analytics)
            $table->string('device_type', 20)->nullable()->comment('mobile, tablet, desktop');
            $table->string('user_agent', 255)->nullable();
            $table->string('ip_address', 45)->nullable();
            
            // Índices
            $table->index('product_id');
            $table->index('user_id');
            $table->index('session_id');
            $table->index('viewed_at');
            $table->index('source');
        });


        // ========================================
        // TABELA 5: CART_WHATSAPP_LOGS
        // ========================================
        // Log de carrinhos enviados via WhatsApp
        // Tracking de conversões

        Schema::create('cart_whatsapp_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            
            // Destinatário
            $table->string('phone_number', 20)->comment('Número que recebeu (loja)');
            
            // Conteúdo
            $table->text('message_content')->comment('Mensagem enviada');
            $table->unsignedInteger('items_count')->comment('Quantos itens no carrinho');
            $table->decimal('cart_total', 10, 2)->comment('Total do carrinho no momento');
            
            // Status
            $table->enum('status', [
                'generated',  // Link gerado
                'clicked',    // Cliente clicou no link
                'sent',       // Mensagem enviada (se conseguirmos rastrear)
                'converted',  // Resultou em venda
                'expired'     // Expirou sem conversão
            ])->default('generated');
            
            // Timestamps
            $table->timestamp('sent_at')->useCurrent();
            $table->timestamp('converted_at')->nullable();
            
            // Índices
            $table->index('cart_id');
            $table->index('status');
            $table->index('sent_at');
        });


        // ========================================
        // TABELA 6: PENDING_CONFIRMATIONS
        // ========================================
        // Confirmações pendentes de fornecedores (consignação)
        // Quando cliente adiciona produto de terceiro, precisamos confirmar stock

        Schema::create('pending_confirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade');
            
            // Timing
            $table->timestamp('requested_at')->useCurrent()->comment('Quando foi solicitada');
            $table->timestamp('expires_at')->nullable()->comment('Prazo limite para resposta');
            $table->timestamp('responded_at')->nullable()->comment('Quando respondeu');
            
            // Status
            $table->enum('status', [
                'pending',    // Aguardando resposta
                'confirmed',  // Fornecedor confirmou disponibilidade
                'rejected',   // Fornecedor não tem stock
                'expired'     // Expirou sem resposta
            ])->default('pending');
            
            // Resposta
            $table->text('response_notes')->nullable()->comment('Notas do fornecedor');
            $table->string('responded_by', 100)->nullable()->comment('Quem respondeu');
            
            $table->timestamps();
            
            // Índices
            $table->index('cart_item_id');
            $table->index('supplier_id');
            $table->index('status');
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_confirmations');
        Schema::dropIfExists('cart_whatsapp_logs');
        Schema::dropIfExists('product_views');
        Schema::dropIfExists('wishlists');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
};