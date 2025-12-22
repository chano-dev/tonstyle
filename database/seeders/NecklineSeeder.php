<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NecklineSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $necklines = [
            [
                'name' => 'Gola Redonda',
                'slug' => 'gola-redonda',
                'description' => 'Gola circular classica.',
                'display_order' => 1,
            ],
            [
                'name' => 'Gola V',
                'slug' => 'gola-v',
                'description' => 'Decote em formato V.',
                'display_order' => 2,
            ],
            [
                'name' => 'Gola Alta',
                'slug' => 'gola-alta',
                'description' => 'Cobre total ou parcialmente o pescoco.',
                'display_order' => 3,
            ],
            [
                'name' => 'Tomara que Caia',
                'slug' => 'tomara-que-caia',
                'description' => 'Sem alcas, deixa os ombros a mostra.',
                'display_order' => 4,
            ],
            [
                'name' => 'Ombro a Ombro',
                'slug' => 'ombro-a-ombro',
                'description' => 'Decote largo que expõe os ombros.',
                'display_order' => 5,
            ],
            [
                'name' => 'Assimetrico',
                'slug' => 'assimetrico',
                'description' => 'Corte irregular ou nao simetrico.',
                'display_order' => 6,
            ],
        ];

        foreach ($necklines as $neckline) {
            DB::table('necklines')->updateOrInsert(
                ['slug' => $neckline['slug']],
                [
                    'name' => $neckline['name'],
                    'description' => $neckline['description'],
                    'is_active' => true,
                    'display_order' => $neckline['display_order'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Necklines seeded: 6 neckline types');
    }
}
