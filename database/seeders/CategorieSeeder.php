<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('categories')->insert([
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
                'created_at' => $now,
                'updated_at' => $now,
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
                'created_at' => $now,
                'updated_at' => $now,
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
                'created_at' => $now,
                'updated_at' => $now,
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
                'created_at' => $now,
                'updated_at' => $now,
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
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $this->command->info('✅ Categories seeded: 5 total (2 active: Roupas, Extra)');        
    }
}
