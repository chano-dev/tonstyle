<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubcategoryServicesSeeder extends Seeder
{
    /**
     * Seed the subcategories table for Services (Extra)
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Categoria: Extra / Serviços
        $subcategories = [
            [
                'name' => 'Serviços de Perucas',
                'slug' => 'servicos-de-perucas',
                'description' => 'Serviços especializados para perucas e extensões capilares, incluindo aplicação, manutenção, personalização e cuidados profissionais.',
                'display_order' => 1,
                'meta_title' => 'Serviços de Perucas em Luanda | Teu Estilo',
                'meta_description' => 'Aplicação, manutenção e personalização de perucas em Luanda. Serviços profissionais com qualidade, conforto e acabamento natural.',
            ],
            [
                'name' => 'Costura e Ajustes',
                'slug' => 'costura-e-ajustes',
                'description' => 'Serviços de costura profissional, ajustes, reformas e confecção sob medida para roupas e peças especiais.',
                'display_order' => 2,
                'meta_title' => 'Costura e Ajustes Profissionais em Angola | Teu Estilo',
                'meta_description' => 'Serviços de costura e ajustes em Luanda: reformas, bainhas, ajustes sob medida e confecção personalizada.',
            ],
            /*[
                'name' => 'Consultoria de Estilo',
                'slug' => 'consultoria-de-estilo',
                'description' => 'Orientação personalizada de imagem, moda e estilo, ajudando clientes a escolherem looks adequados para cada ocasião.',
                'display_order' => 3,
                'meta_title' => 'Consultoria de Estilo em Luanda | Teu Estilo',
                'meta_description' => 'Consultoria de estilo profissional em Luanda. Imagem pessoal, looks personalizados e orientação de moda.',
            ],*/
            [
                'name' => 'Aluguer de Vestidos',
                'slug' => 'aluguer-de-vestidos',
                'description' => 'Serviço de aluguer de vestidos para eventos especiais, festas, cerimónias e ocasiões formais.',
                'display_order' => 3,
                'meta_title' => 'Aluguer de Vestidos em Luanda | Teu Estilo',
                'meta_description' => 'Aluguer de vestidos elegantes em Luanda para festas, casamentos e eventos especiais. Qualidade e sofisticação.',
            ],
            [
                'name' => 'Maquiagem',
                'slug' => 'maquiagem',
                'description' => 'Serviços profissionais de maquiagem para eventos, sessões fotográficas, cerimónias e ocasiões especiais.',
                'display_order' => 4,
                'meta_title' => 'Serviços de Maquiagem Profissional em Luanda | Teu Estilo',
                'meta_description' => 'Maquiagem profissional em Luanda para eventos, noivas, festas e produções especiais.',
            ],
        ];

        foreach ($subcategories as $subcategory) {
            DB::table('subcategories')->updateOrInsert(
                [
                    'slug' => $subcategory['slug'],
                    'category_id' => 5,
                    'segment_id' => 1, // Extra / Serviços
                ],
                [
                    'name' => $subcategory['name'],
                    'description' => $subcategory['description'],
                    'image_path' => null,
                    'is_active' => true,
                    'display_order' => $subcategory['display_order'],
                    'meta_title' => $subcategory['meta_title'],
                    'meta_description' => $subcategory['meta_description'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Subcategories seeded: Serviços (Categoria Extra)');
    }
}
