<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StyleSeeder extends Seeder
{
    /**
     * Seed the styles table.
     * Universal visual aesthetics applicable to clothing, footwear, accessories, and more.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $styles = [
            [
                'name' => 'Casual',
                'slug' => 'casual',
                'description' => 'Confortável, descontraído e versátil para o dia a dia.',
                'display_order' => 1,
            ],
            [
                'name' => 'Elegante',
                'slug' => 'elegante',
                'description' => 'Refinado, polido e sofisticado — ideal para ocasiões importantes.',
                'display_order' => 2,
            ],
            [
                'name' => 'Boémio',
                'slug' => 'boemio',
                'description' => 'Livres, fluidos, com camadas e detalhes artesanais — estilo nómada.',
                'display_order' => 3,
            ],
            [
                'name' => 'Vintage',
                'slug' => 'vintage',
                'description' => 'Inspirado em décadas passadas — anos 60, 70, 80 ou 90.',
                'display_order' => 4,
            ],
            [
                'name' => 'Minimalista',
                'slug' => 'minimalista',
                'description' => 'Linhas limpas, cores neutras e sem excessos — “less is more”.',
                'display_order' => 5,
            ],
            [
                'name' => 'Sexy',
                'slug' => 'sexy',
                'description' => 'Ajustado, com recortes, transparências ou decotes marcantes.',
                'display_order' => 6,
            ],
            [
                'name' => 'Streetwear',
                'slug' => 'streetwear',
                'description' => 'Inspirado na cultura urbana — oversized, logomania, sneakers.',
                'display_order' => 7,
            ],
            [
                'name' => 'Clássico',
                'slug' => 'classico',
                'description' => 'Atemporal, com peças como blazers, trench coats e calças retas.',
                'display_order' => 8,
            ],
            [
                'name' => 'Moda Étnica',
                'slug' => 'moda-etnica',
                'description' => 'Peças com padrões, tecidos ou cortes inspirados em culturas africanas.',
                'display_order' => 9,
            ],
            [
                'name' => 'Glamour',
                'slug' => 'glamour',
                'description' => 'Brilhos, lantejoulas, tecidos luxuosos e silhuetas dramáticas.',
                'display_order' => 10,
            ],
            [
                'name' => 'Sustentável',
                'slug' => 'sustentavel',
                'description' => 'Produzido com materiais ecológicos ou processos éticos.',
                'display_order' => 11,
            ],
            [
                'name' => 'Experimental',
                'slug' => 'experimental',
                'description' => 'Design inovador, cortes assimétricos, materiais não convencionais.',
                'display_order' => 12,
            ],
        ];

        foreach ($styles as $style) {
            DB::table('styles')->updateOrInsert(['slug' => $style['slug']],
            [
                'name' => $style['name'],
                'description' => $style['description'],
                'is_active' => true,
                'display_order' => $style['display_order'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Styles seeded: 12 styles (Casual, Elegante, Boémio, Vintage, Minimalista, Sexy, Streetwear, Clássico, Moda Étnica, Glamour, Sustentável, Experimental)');
    }
}