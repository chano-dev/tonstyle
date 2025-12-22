<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SleeveSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $sleeves = [
            [
                'name' => 'Sem Manga',
                'slug' => 'sem-manga',
                'description' => 'Sem cobertura dos bracos.',
                'display_order' => 1,
            ],
            [
                'name' => 'Manga Curta',
                'slug' => 'manga-curta',
                'description' => 'Manga acima do cotovelo.',
                'display_order' => 2,
            ],
            [
                'name' => 'Manga Tres Quartos',
                'slug' => 'manga-tres-quartos',
                'description' => 'Manga entre o cotovelo e o pulso.',
                'display_order' => 3,
            ],
            [
                'name' => 'Manga Longa',
                'slug' => 'manga-longa',
                'description' => 'Manga ate o pulso.',
                'display_order' => 4,
            ],
            [
                'name' => 'Manga Bufante',
                'slug' => 'manga-bufante',
                'description' => 'Manga com volume acentuado.',
                'display_order' => 5,
            ],
            [
                'name' => 'Manga Ajustada',
                'slug' => 'manga-ajustada',
                'description' => 'Manga justa ao braco.',
                'display_order' => 6,
            ],
        ];

        foreach ($sleeves as $sleeve) {
            DB::table('sleeves')->updateOrInsert(
                ['slug' => $sleeve['slug']],
                [
                    'name' => $sleeve['name'],
                    'description' => $sleeve['description'],
                    'is_active' => true,
                    'display_order' => $sleeve['display_order'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Sleeves seeded: 6 sleeve types');
    }
}
