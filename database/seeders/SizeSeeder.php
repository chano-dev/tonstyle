<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SizeSeeder extends Seeder
{
    /**
     * Seed the sizes table.
     * Includes: Clothing (XS-XXXL), Footwear (35-44), Accessories (Único, P, M, G)
     */
    public function run(): void
    {
        $now = Carbon::now();
        $order = 1;

        $sizes = [
            // === ROUPAS (clothing) ===
            ['name' => 'XXS', 'size_type' => 'clothing', 'description' => 'Extra extra pequeno - Veste 32-34'],
            ['name' => 'XS', 'size_type' => 'clothing', 'description' => 'Extra pequeno - Veste 34-36'],
            ['name' => 'S', 'size_type' => 'clothing', 'description' => 'Pequeno - Veste 36-38'],
            ['name' => 'M', 'size_type' => 'clothing', 'description' => 'Médio - Veste 38-40'],
            ['name' => 'L', 'size_type' => 'clothing', 'description' => 'Grande - Veste 40-42'],
            ['name' => 'XL', 'size_type' => 'clothing', 'description' => 'Extra grande - Veste 42-44'],
            ['name' => 'XXL', 'size_type' => 'clothing', 'description' => 'Extra extra grande - Veste 44-46'],
            ['name' => 'XXXL', 'size_type' => 'clothing', 'description' => 'Veste 46-48'],
            ['name' => '34', 'size_type' => 'clothing', 'description' => 'Tamanho numérico 34'],
            ['name' => '36', 'size_type' => 'clothing', 'description' => 'Tamanho numérico 36'],
            ['name' => '38', 'size_type' => 'clothing', 'description' => 'Tamanho numérico 38'],
            ['name' => '40', 'size_type' => 'clothing', 'description' => 'Tamanho numérico 40'],
            ['name' => '42', 'size_type' => 'clothing', 'description' => 'Tamanho numérico 42'],
            ['name' => '44', 'size_type' => 'clothing', 'description' => 'Tamanho numérico 44'],
            ['name' => '46', 'size_type' => 'clothing', 'description' => 'Tamanho numérico 46'],
            ['name' => '48', 'size_type' => 'clothing', 'description' => 'Tamanho numérico 48'],
            ['name' => '50', 'size_type' => 'clothing', 'description' => 'Tamanho numérico 50'],
            ['name' => '52', 'size_type' => 'clothing', 'description' => 'Tamanho numérico 52'],
            
            // === CALÇADOS (footwear) ===
            ['name' => '35', 'size_type' => 'footwear', 'description' => 'Calçado tamanho 35 (EU)'],
            ['name' => '36', 'size_type' => 'footwear', 'description' => 'Calçado tamanho 36 (EU)'],
            ['name' => '37', 'size_type' => 'footwear', 'description' => 'Calçado tamanho 37 (EU)'],
            ['name' => '38', 'size_type' => 'footwear', 'description' => 'Calçado tamanho 38 (EU)'],
            ['name' => '39', 'size_type' => 'footwear', 'description' => 'Calçado tamanho 39 (EU)'],
            ['name' => '40', 'size_type' => 'footwear', 'description' => 'Calçado tamanho 40 (EU)'],
            ['name' => '41', 'size_type' => 'footwear', 'description' => 'Calçado tamanho 41 (EU)'],
            ['name' => '42', 'size_type' => 'footwear', 'description' => 'Calçado tamanho 42 (EU)'],
            ['name' => '43', 'size_type' => 'footwear', 'description' => 'Calçado tamanho 43 (EU)'],
            ['name' => '44', 'size_type' => 'footwear', 'description' => 'Calçado tamanho 44 (EU)'],
            
            // === ACESSÓRIOS (accessories) ===
            // Tamanhos gerais
            ['name' => 'Único', 'size_type' => 'accessories', 'description' => 'Tamanho único - Ajustável'],
            ['name' => 'P', 'size_type' => 'accessories', 'description' => 'Pequeno para acessórios'],
            ['name' => 'M', 'size_type' => 'accessories', 'description' => 'Médio para acessórios'],
            ['name' => 'G', 'size_type' => 'accessories', 'description' => 'Grande para acessórios'],
            
            // Cintos (cm)
            ['name' => '75cm', 'size_type' => 'accessories', 'description' => 'Cinto 75cm'],
            ['name' => '80cm', 'size_type' => 'accessories', 'description' => 'Cinto 80cm'],
            ['name' => '85cm', 'size_type' => 'accessories', 'description' => 'Cinto 85cm'],
            ['name' => '90cm', 'size_type' => 'accessories', 'description' => 'Cinto 90cm'],
            ['name' => '95cm', 'size_type' => 'accessories', 'description' => 'Cinto 95cm'],
            ['name' => '100cm', 'size_type' => 'accessories', 'description' => 'Cinto 100cm'],
            ['name' => '105cm', 'size_type' => 'accessories', 'description' => 'Cinto 105cm'],
            ['name' => '110cm', 'size_type' => 'accessories', 'description' => 'Cinto 110cm'],
            
            // Anéis
            ['name' => 'Anel 12', 'size_type' => 'accessories', 'description' => 'Anel tamanho 12 (14mm)'],
            ['name' => 'Anel 14', 'size_type' => 'accessories', 'description' => 'Anel tamanho 14 (15mm)'],
            ['name' => 'Anel 16', 'size_type' => 'accessories', 'description' => 'Anel tamanho 16 (16mm)'],
            ['name' => 'Anel 18', 'size_type' => 'accessories', 'description' => 'Anel tamanho 18 (17mm)'],
            ['name' => 'Anel 20', 'size_type' => 'accessories', 'description' => 'Anel tamanho 20 (18mm)'],
            ['name' => 'Anel 22', 'size_type' => 'accessories', 'description' => 'Anel tamanho 22 (19mm)'],
            ['name' => 'Anel 24', 'size_type' => 'accessories', 'description' => 'Anel tamanho 24 (20mm)'],
            
            // Pulseiras
            ['name' => 'Pulseira 16cm', 'size_type' => 'accessories', 'description' => 'Pulseira 16cm - Pulso fino'],
            ['name' => 'Pulseira 17cm', 'size_type' => 'accessories', 'description' => 'Pulseira 17cm - Pulso pequeno'],
            ['name' => 'Pulseira 18cm', 'size_type' => 'accessories', 'description' => 'Pulseira 18cm - Pulso médio'],
            ['name' => 'Pulseira 19cm', 'size_type' => 'accessories', 'description' => 'Pulseira 19cm - Pulso grande'],
            ['name' => 'Pulseira 20cm', 'size_type' => 'accessories', 'description' => 'Pulseira 20cm - Pulso extra grande'],
            ['name' => 'Pulseira Ajustável', 'size_type' => 'accessories', 'description' => 'Pulseira com fecho ajustável'],
            
            // === UNIVERSAL ===
            ['name' => 'Tamanho Único', 'size_type' => 'universal', 'description' => 'Serve para todos os tamanhos'],
            ['name' => 'Ajustável', 'size_type' => 'universal', 'description' => 'Tamanho ajustável'],
        ];

        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
                'name' => $size['name'],
                'slug' => Str::slug($size['name']),
                'size_type' => $size['size_type'],
                'description' => $size['description'],
                'is_active' => true,
                'display_order' => $order++,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Sizes seeded: ' . count($sizes) . ' sizes (clothing, footwear, accessories, universal)');
    }
}