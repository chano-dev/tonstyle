<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        $order = 1;

        $materials = [
            // === TECIDOS NATURAIS ===
            ['name' => 'Algodão', 'description' => 'Tecido natural, macio e respirável. Ideal para o clima quente.', 'material_type' => 'fabric', 'is_natural' => true, 'care_level' => 'easy'],
            ['name' => 'Algodão Orgânico', 'description' => 'Algodão cultivado sem pesticidas. Hipoalergénico.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'easy'],
            ['name' => 'Linho', 'description' => 'Fibra natural leve e fresca. Perfeito para dias quentes.', 'material_type' => 'fabric', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Seda', 'description' => 'Tecido luxuoso, macio e brilhante.', 'material_type' => 'fabric', 'is_natural' => true, 'care_level' => 'delicate'],
            ['name' => 'Lã', 'description' => 'Fibra natural quente e isolante.', 'material_type' => 'fabric', 'is_natural' => true, 'care_level' => 'delicate'],
            ['name' => 'Cashmere', 'description' => 'Lã de cabra cashmere, extremamente macia e luxuosa.', 'material_type' => 'fabric', 'is_natural' => true, 'care_level' => 'delicate'],
            ['name' => 'Bambu', 'description' => 'Tecido ecológico antibacteriano e macio.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'easy'],
            ['name' => 'Juta', 'description' => 'Fibra natural rústica para bolsas artesanais.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'easy'],
            ['name' => 'Ráfia', 'description' => 'Fibra de palmeira para bolsas e chapéus.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'moderate'],

            // === TECIDOS SINTÉTICOS ===
            ['name' => 'Poliéster', 'description' => 'Tecido sintético resistente e durável.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Viscose', 'description' => 'Semi-sintético com toque suave similar à seda.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'moderate'],
            ['name' => 'Rayon', 'description' => 'Fibra regenerada, leve e confortável.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'moderate'],
            ['name' => 'Nylon', 'description' => 'Tecido sintético resistente e elástico.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Elastano', 'description' => 'Fibra elástica (Lycra/Spandex).', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Acrílico', 'description' => 'Alternativa sintética à lã.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Microfibra', 'description' => 'Tecido ultrafino de secagem rápida.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Tactel', 'description' => 'Tecido leve para moda praia e fitness.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Suplex', 'description' => 'Tecido elástico para moda fitness.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'easy'],

            // === TECIDOS ESPECIAIS ===
            ['name' => 'Cetim', 'description' => 'Tecido com brilho elegante para festas.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'delicate'],
            ['name' => 'Veludo', 'description' => 'Tecido macio com textura aveludada.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'delicate'],
            ['name' => 'Chiffon', 'description' => 'Tecido leve e transparente, fluido.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'delicate'],
            ['name' => 'Organza', 'description' => 'Tecido fino e transparente com estrutura.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'delicate'],
            ['name' => 'Tule', 'description' => 'Tecido de rede fino para saias e véus.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'delicate'],
            ['name' => 'Renda', 'description' => 'Tecido delicado com padrões vazados.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'delicate'],
            ['name' => 'Guipure', 'description' => 'Renda grossa e encorpada.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'delicate'],
            ['name' => 'Tricô', 'description' => 'Tecido de malha texturizado.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'moderate'],
            ['name' => 'Crochê', 'description' => 'Técnica artesanal de malha boho.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'delicate'],
            ['name' => 'Moletom', 'description' => 'Tecido de malha felpudo confortável.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Jersey', 'description' => 'Malha elástica e versátil.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Malha', 'description' => 'Tecido elástico para uso diário.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Crepe', 'description' => 'Tecido com textura granulada elegante.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'moderate'],
            ['name' => 'Gabardine', 'description' => 'Tecido resistente para calças e blazers.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Tweed', 'description' => 'Tecido de lã texturizado estilo Chanel.', 'material_type' => 'fabric', 'is_natural' => true, 'care_level' => 'delicate'],
            ['name' => 'Jacquard', 'description' => 'Tecido com padrões tecidos sofisticados.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'moderate'],
            ['name' => 'Brocado', 'description' => 'Tecido luxuoso com fios metálicos.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'delicate'],
            ['name' => 'Lantejoulas', 'description' => 'Tecido com discos brilhantes para festas.', 'material_type' => 'fabric', 'is_natural' => false, 'care_level' => 'delicate'],

            // === JEANS E DENIM ===
            ['name' => 'Jeans', 'description' => 'Tecido denim clássico durável.', 'material_type' => 'fabric', 'is_natural' => true, 'care_level' => 'easy'],
            ['name' => 'Jeans Stretch', 'description' => 'Denim com elastano confortável.', 'material_type' => 'mixed', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Chambray', 'description' => 'Tecido similar ao jeans mas mais leve.', 'material_type' => 'fabric', 'is_natural' => true, 'care_level' => 'easy'],

            // === COURO E DERIVADOS ===
            ['name' => 'Couro Legítimo', 'description' => 'Couro animal genuíno premium.', 'material_type' => 'leather', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Couro de Cobra', 'description' => 'Couro exótico com textura de escamas.', 'material_type' => 'leather', 'is_natural' => true, 'care_level' => 'delicate'],
            ['name' => 'Camurça', 'description' => 'Couro com acabamento aveludado.', 'material_type' => 'leather', 'is_natural' => true, 'care_level' => 'delicate'],
            ['name' => 'Nobuck', 'description' => 'Couro lixado com textura suave.', 'material_type' => 'leather', 'is_natural' => true, 'care_level' => 'delicate'],
            ['name' => 'Couro Sintético', 'description' => 'Imitação de couro acessível.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Couro Ecológico', 'description' => 'Alternativa vegana sustentável.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Napa', 'description' => 'Couro macio e flexível de alta qualidade.', 'material_type' => 'leather', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Verniz', 'description' => 'Acabamento brilhante envernizado.', 'material_type' => 'leather', 'is_natural' => false, 'care_level' => 'moderate'],

            // === METAIS (Joias e Acessórios) ===
            ['name' => 'Ouro 18k', 'description' => 'Ouro 18 quilates (75% ouro). Alto valor.', 'material_type' => 'metal', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Ouro 14k', 'description' => 'Ouro 14 quilates durável.', 'material_type' => 'metal', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Ouro Branco', 'description' => 'Liga de ouro com aparência prateada.', 'material_type' => 'metal', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Ouro Rose', 'description' => 'Liga de ouro com tom rosado.', 'material_type' => 'metal', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Prata 925', 'description' => 'Prata de lei (92.5% prata).', 'material_type' => 'metal', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Aço Inoxidável', 'description' => 'Metal durável e hipoalergénico.', 'material_type' => 'metal', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Aço Cirúrgico', 'description' => 'Aço hipoalergénico para peles sensíveis.', 'material_type' => 'metal', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Titânio', 'description' => 'Metal leve, resistente e hipoalergénico.', 'material_type' => 'metal', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Bronze', 'description' => 'Liga de cobre e estanho vintage.', 'material_type' => 'metal', 'is_natural' => false, 'care_level' => 'moderate'],
            ['name' => 'Latão', 'description' => 'Liga dourada acessível.', 'material_type' => 'metal', 'is_natural' => false, 'care_level' => 'moderate'],
            ['name' => 'Platina', 'description' => 'Metal precioso raro e luxuoso.', 'material_type' => 'metal', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Folheado a Ouro', 'description' => 'Camada de ouro sobre metal base.', 'material_type' => 'metal', 'is_natural' => false, 'care_level' => 'moderate'],
            ['name' => 'Banhado a Ouro', 'description' => 'Banho fino de ouro acessível.', 'material_type' => 'metal', 'is_natural' => false, 'care_level' => 'moderate'],

            // === PEDRAS E CRISTAIS ===
            ['name' => 'Diamante', 'description' => 'Pedra preciosa mais valiosa.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'easy'],
            ['name' => 'Zircónia', 'description' => 'Cristal sintético similar ao diamante.', 'material_type' => 'glass', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Cristal Swarovski', 'description' => 'Cristais de precisão austríacos.', 'material_type' => 'glass', 'is_natural' => false, 'care_level' => 'delicate'],
            ['name' => 'Pérola Natural', 'description' => 'Pérola formada naturalmente.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'delicate'],
            ['name' => 'Pérola Cultivada', 'description' => 'Pérola cultivada de qualidade.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'delicate'],
            ['name' => 'Pérola Sintética', 'description' => 'Imitação de pérola acessível.', 'material_type' => 'plastic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Madrepérola', 'description' => 'Revestimento interno de conchas.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'delicate'],
            ['name' => 'Turquesa', 'description' => 'Pedra semi-preciosa azul-esverdeada.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Ametista', 'description' => 'Quartzo roxo elegante.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Quartzo Rosa', 'description' => 'Pedra rosa delicada e feminina.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'moderate'],

            // === PLÁSTICOS E OUTROS ===
            ['name' => 'Resina', 'description' => 'Material moldável para bijuterias.', 'material_type' => 'plastic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'PVC', 'description' => 'Plástico flexível impermeável.', 'material_type' => 'plastic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Silicone', 'description' => 'Material flexível e durável.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Borracha', 'description' => 'Material elástico resistente.', 'material_type' => 'synthetic', 'is_natural' => false, 'care_level' => 'easy'],
            ['name' => 'Madeira', 'description' => 'Material natural para botões e acessórios.', 'material_type' => 'wood', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Cortiça', 'description' => 'Material natural sustentável português.', 'material_type' => 'wood', 'is_natural' => true, 'care_level' => 'easy'],
            ['name' => 'Palha', 'description' => 'Fibra natural para chapéus e bolsas.', 'material_type' => 'natural', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Tecido Africano', 'description' => 'Tecidos tradicionais africanos coloridos.', 'material_type' => 'fabric', 'is_natural' => true, 'care_level' => 'moderate'],
            ['name' => 'Capulana', 'description' => 'Tecido tradicional africano estampado.', 'material_type' => 'fabric', 'is_natural' => true, 'care_level' => 'easy'],
        ];

        foreach ($materials as $material) {
            DB::table('materials')->updateOrInsert(['slug' => Str::slug($material['name'])],
            [
                'name' => $material['name'],
                'description' => $material['description'],
                'material_type' => $material['material_type'],
                'is_natural' => $material['is_natural'],
                'care_level' => $material['care_level'],
                'is_active' => true,
                'display_order' => $order++,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Materials seeded: ' . count($materials) . ' materials (fabrics, metals, leather, stones, plastics)');
    }
}