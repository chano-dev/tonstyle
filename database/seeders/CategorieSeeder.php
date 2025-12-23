<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $categories = [
            [
                'name' => 'Roupas',
                'slug' => 'roupas',
                'description' => 'Roupas femininas em Angola: vestidos elegantes, blusas modernas, calças versáteis, saias e conjuntos. Moda para todas as ocasiões.',
                'icon' => 'fa-solid fa-shirt',
                'image_path' => null,
                'is_active' => true,
                'display_order' => 1,
                'meta_title' => 'Roupas Femininas Angola - Vestidos e Blusas | Teu Estilo',
                'meta_description' => 'Descubra roupas femininas em Luanda: vestidos para festa e trabalho, blusas elegantes, calças e saias. Qualidade e estilo para todas as ocasiões. Compre já!',
            ],
            [
                'name' => 'Calçados',
                'slug' => 'calcados',
                'description' => 'Calçados femininos em Angola: saltos altos, sandálias elegantes, sabrinas confortáveis, chinelos e botas. Estilo e conforto para seus pés.',
                'icon' => 'fa-solid fa-shoe-prints',
                'image_path' => null,
                'is_active' => false,
                'display_order' => 2,
                'meta_title' => 'Calçados Femininos Angola - Saltos e Sandálias | Teu Estilo',
                'meta_description' => 'Sapatos femininos em Luanda: saltos elegantes, sandálias confortáveis, sabrinas e chinelos. Qualidade e estilo para todas as ocasiões. Entrega rápida!',
            ],
            [
                'name' => 'Acessórios',
                'slug' => 'acessorios',
                'description' => 'Acessórios femininos em Angola: bolsas, jóias (pulseiras, colares, brincos), relógios, óculos de sol e carteiras. Complete seu look com estilo.',
                'icon' => 'fa-solid fa-gem',
                'image_path' => null,
                'is_active' => false,
                'display_order' => 3,
                'meta_title' => 'Acessórios Femininos Angola - Bolsas e Jóias | Teu Estilo',
                'meta_description' => 'Acessórios femininos em Luanda: bolsas elegantes, jóias (colares, brincos, pulseiras), relógios e óculos. Complete seu look com estilo. Compre online!',
            ],
            [
                'name' => 'Cosméticos',
                'slug' => 'cosmeticos',
                'description' => 'Cosméticos e produtos de beleza em Angola: perfumes importados, maquilhagem profissional, produtos capilares e cuidados com a pele.',
                'icon' => 'fa-solid fa-spray-can',
                'image_path' => null,
                'is_active' => false,
                'display_order' => 4,
                'meta_title' => 'Cosméticos Angola - Perfumes e Maquilhagem | Teu Estilo',
                'meta_description' => 'Cosméticos de qualidade em Luanda: perfumes importados, maquilhagem profissional, produtos capilares e skincare. Beleza e bem-estar. Entrega em Angola!',
            ],
            [
                'name' => 'Extra',
                'slug' => 'extra',
                'description' => 'Serviços especiais de moda em Angola: aluguer de vestidos para eventos, costura personalizada, alfaiataria sob medida, aplicação de perucas e consultoria de estilo.',
                'icon' => 'fa-solid fa-star',
                'image_path' => null,
                'is_active' => true,
                'display_order' => 5,
                'meta_title' => 'Serviços de Moda Angola - Costura e Aluguer | Teu Estilo',
                'meta_description' => 'Serviços exclusivos em Luanda: aluguer de vestidos para festas, costura personalizada, aplicação de perucas profissional e consultoria de estilo. Agende já!',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['slug' => $category['slug']], // Chave única
                [
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'icon' => $category['icon'],
                    'image_path' => $category['image_path'],
                    'is_active' => $category['is_active'],
                    'display_order' => $category['display_order'],
                    'meta_title' => $category['meta_title'],
                    'meta_description' => $category['meta_description'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Categories seeded: 5 categories (2 active: Roupas, Extra)');
    }
}