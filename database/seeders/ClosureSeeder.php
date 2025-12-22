<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClosureSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $closures = [
            ['name' => 'Ziper', 'slug' => 'ziper', 'description' => 'Fecho em metal ou plastico usado em roupas, calcados e bolsas.', 'display_order' => 1],
            ['name' => 'Botoes', 'slug' => 'botoes', 'description' => 'Fecho classico com botoes de plastico, metal, madeira ou tecido.', 'display_order' => 2],
            ['name' => 'Velcro', 'slug' => 'velcro', 'description' => 'Sistema aderente pratico, comum em calcados e acessorios.', 'display_order' => 3],
            ['name' => 'Elastico', 'slug' => 'elastico', 'description' => 'Ajuste flexivel sem fecho mecanico.', 'display_order' => 4],
            ['name' => 'Fivela', 'slug' => 'fivela', 'description' => 'Fecho com ajuste manual, comum em cintos, sandalias e bolsas.', 'display_order' => 5],
            ['name' => 'Amarracao', 'slug' => 'amarracao', 'description' => 'Cordoes, lacos ou fitas para fechamento ajustavel.', 'display_order' => 6],
            ['name' => 'Pressao', 'slug' => 'pressao', 'description' => 'Botoes de encaixe rapido, discretos e praticos.', 'display_order' => 7],
            ['name' => 'Magnetico', 'slug' => 'magnetico', 'description' => 'Fecho por imas, comum em bolsas e joias.', 'display_order' => 8],
            ['name' => 'Sem Fecho', 'slug' => 'sem-fecho', 'description' => 'Produto sem sistema de fechamento.', 'display_order' => 9],
        ];

        foreach ($closures as $closure) {
            DB::table('closures')->updateOrInsert(
                ['slug' => $closure['slug']],
                [
                    'name' => $closure['name'],
                    'description' => $closure['description'],
                    'is_active' => true,
                    'display_order' => $closure['display_order'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Closures seeded: 9 closure types');
    }
}
