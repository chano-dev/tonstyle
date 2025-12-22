<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SubcategorySeeder extends Seeder
{
    /**
     * Seed the subcategories table.
     * Initial launch: Mulher > Roupas (10 subcategories)
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Mulher (segment_id = 1) + Roupas (category_id = 1)
        $subcategories = [
            [
                'name' => 'Vestidos',
                'slug' => 'vestidos',
                'description' => 'Vestidos elegantes para todas as ocasiões. Do casual ao formal, encontre o modelo perfeito para cada momento.',
                'display_order' => 1,
                'meta_title' => 'Vestidos Femininos em Angola | Teu Estilo',
                'meta_description' => 'Descubra vestidos elegantes em Luanda: longos, curtos, midi, de festa e casual. Qualidade e estilo para todas as ocasiões. Entrega rápida em Angola.',
            ],
            [
                'name' => 'Blusas',
                'slug' => 'blusas',
                'description' => 'Blusas modernas e versáteis para o dia a dia e ocasiões especiais. Variedade de cortes, cores e tecidos.',
                'display_order' => 2,
                'meta_title' => 'Blusas Femininas em Angola | Teu Estilo',
                'meta_description' => 'Blusas femininas elegantes em Luanda: sociais, casuais, cropped e mais. Tecidos de qualidade e estilos modernos. Compre online.',
            ],
            [
                'name' => 'Blazers',
                'slug' => 'blazers',
                'description' => 'Blazers sofisticados para um look profissional e elegante. Perfeitos para o trabalho e eventos formais.',
                'display_order' => 3,
                'meta_title' => 'Blazers Femininos em Angola | Teu Estilo',
                'meta_description' => 'Blazers femininos elegantes em Luanda: sociais, casuais e oversized. Estilo profissional com qualidade. Entrega em Angola.',
            ],
            [
                'name' => 'Saias',
                'slug' => 'saias',
                'description' => 'Saias elegantes em diversos comprimentos e estilos. Midi, longas, curtas e plissadas para todos os gostos.',
                'display_order' => 4,
                'meta_title' => 'Saias Femininas em Angola | Teu Estilo',
                'meta_description' => 'Saias femininas em Luanda: midi, longas, curtas, plissadas e de fenda. Elegância e estilo para todas as ocasiões. Compre online.',
            ],
            [
                'name' => 'Conjuntos',
                'slug' => 'conjuntos',
                'description' => 'Conjuntos coordenados prontos para usar. Praticidade e estilo em peças que combinam perfeitamente.',
                'display_order' => 5,
                'meta_title' => 'Conjuntos Femininos em Angola | Teu Estilo',
                'meta_description' => 'Conjuntos femininos em Luanda: calça e blusa, saia e top, fatos completos. Looks prontos com estilo. Entrega rápida em Angola.',
            ],
            [
                'name' => 'Calças',
                'slug' => 'calcas',
                'description' => 'Calças femininas versáteis para todas as ocasiões. Jeans, sociais, leggings e muito mais.',
                'display_order' => 6,
                'meta_title' => 'Calças Femininas em Angola | Teu Estilo',
                'meta_description' => 'Calças femininas em Luanda: jeans, sociais, palazzo, leggings e skinny. Conforto e estilo para o dia a dia. Compre online.',
            ],
            [
                'name' => 'Batas',
                'slug' => 'batas',
                'description' => 'Batas confortáveis e elegantes. Perfeitas para looks casuais com um toque de sofisticação africana.',
                'display_order' => 7,
                'meta_title' => 'Batas Femininas em Angola | Teu Estilo',
                'meta_description' => 'Batas femininas em Luanda: tradicionais, modernas e estampadas. Conforto com estilo africano. Entrega em toda Angola.',
            ],
            [
                'name' => 'Camisas',
                'slug' => 'camisas',
                'description' => 'Camisas femininas clássicas e modernas. Do estilo social ao casual, encontre a camisa ideal.',
                'display_order' => 8,
                'meta_title' => 'Camisas Femininas em Angola | Teu Estilo',
                'meta_description' => 'Camisas femininas em Luanda: sociais, jeans, oversized e clássicas. Qualidade e elegância para o trabalho e lazer. Compre online.',
            ],
            [
                'name' => 'Fatos de Banho',
                'slug' => 'fatos-de-banho',
                'description' => 'Fatos de banho, biquínis e moda praia. Estilo e conforto para aproveitar o sol angolano.',
                'display_order' => 9,
                'meta_title' => 'Fatos de Banho e Biquínis em Angola | Teu Estilo',
                'meta_description' => 'Fatos de banho e biquínis em Luanda: inteiros, de duas peças, saídas de praia. Moda praia com estilo. Entrega rápida.',
            ],
            [
                'name' => 'Casacos',
                'slug' => 'casacos',
                'description' => 'Casacos e jaquetas para os dias mais frescos. Estilo e proteção com elegância.',
                'display_order' => 10,
                'meta_title' => 'Casacos Femininos em Angola | Teu Estilo',
                'meta_description' => 'Casacos femininos em Luanda: jaquetas, sobretudos, teddy e jeans. Proteção com estilo para o cacimbo. Compre online.',
            ],
        ];

        foreach ($subcategories as $subcategory) {
            DB::table('subcategories')->updateOrInsert([
                'slug' => $subcategory['slug'],
                'category_id' => 1, // Roupas
                'segment_id' => 1,  // Mulher
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
            ]);
        }

        $this->command->info('✅ Subcategories seeded: 10 subcategories (Mulher > Roupas)');
    }
}