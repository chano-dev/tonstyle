<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SegmentSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $segments = [
            [
                'name' => 'Mulher',
                'slug' => 'mulher',
                'description' => 'Moda feminina em Angola: vestidos, blusas, calçados e acessórios. Costura personalizada, aluguer de vestidos e consultoria de estilo.',
                'icon' => 'fa-solid fa-venus',
                'is_active' => true,
                'display_order' => 1,
                'meta_title' => 'Moda Feminina Angola - Vestidos e Roupas | Teu Estilo Luanda',
                'meta_description' => 'Descubra moda feminina exclusiva em Luanda: vestidos elegantes, blusas, saias, sapatos e bolsas. Serviços de costura, aluguer e perucas. Compre pelo WhatsApp!',
            ],
            [
                'name' => 'Homem',
                'slug' => 'homem',
                'description' => 'Moda masculina moderna em Angola: camisas, calças, fatos, sapatos e acessórios para o homem elegante e urbano.',
                'icon' => 'fa-solid fa-mars',
                'is_active' => false,
                'display_order' => 2,
                'meta_title' => 'Moda Masculina Angola - Roupas para Homem | Teu Estilo',
                'meta_description' => 'Roupa masculina de qualidade em Angola: camisas, calças, fatos e sapatos. Estilo moderno para trabalho, festa e dia-a-dia. Entrega em Luanda!',
            ],
            [
                'name' => 'Criança',
                'slug' => 'crianca',
                'description' => 'Moda infantil em Angola: roupas confortáveis e estilosas para meninos e meninas. Qualidade e segurança para os pequenos.',
                'icon' => 'fa-solid fa-child',
                'is_active' => false,
                'display_order' => 3,
                'meta_title' => 'Moda Infantil Angola - Roupas para Crianças | Teu Estilo',
                'meta_description' => 'Roupas infantis de qualidade em Luanda: vestidos, conjuntos, calçados e acessórios. Moda confortável e segura para meninos e meninas. Compre já!',
            ],
            [
                'name' => 'Blog',
                'slug' => 'blog',
                'description' => 'Dicas de moda, tendências, styling e novidades do mundo fashion angolano. Inspire-se e descubra seu estilo.',
                'icon' => 'fa-solid fa-newspaper',
                'is_active' => false,
                'display_order' => 4,
                'meta_title' => 'Blog de Moda Angola - Tendências e Dicas | Teu Estilo',
                'meta_description' => 'Descubra dicas de moda, tendências fashion em Angola, guias de estilo e novidades. Inspire-se com looks para todas as ocasiões. Leia nosso blog!',
            ],
            [
                'name' => 'Sobre',
                'slug' => 'sobre',
                'description' => 'A história da Teu Estilo: moda angolana com qualidade, acessibilidade e atendimento personalizado. Conheça nossa missão e valores.',
                'icon' => 'fa-solid fa-info-circle',
                'is_active' => true,
                'display_order' => 5,
                'meta_title' => 'Sobre a Teu Estilo - Moda Angolana de Qualidade | Luanda',
                'meta_description' => 'Conheça a Teu Estilo: loja online de Roupas com +1 ano no mercado. Nossa missão, valores e compromisso com estilo e acessibilidade.',
            ],
        ];

        foreach ($segments as $segment) {
            DB::table('segments')->updateOrInsert(
                ['slug' => $segment['slug']], // Chave única
                [
                    'name' => $segment['name'],
                    'description' => $segment['description'],
                    'icon' => $segment['icon'],
                    'is_active' => $segment['is_active'],
                    'display_order' => $segment['display_order'],
                    'meta_title' => $segment['meta_title'],
                    'meta_description' => $segment['meta_description'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Segments seeded: 5 segments (Mulher, Homem, Criança, Blog, Sobre)');
    }
}