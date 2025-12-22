<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FitSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $fits = [
            [
                'name' => 'Slim',
                'slug' => 'slim',
                'description' => 'Caimento justo ao corpo, valorizando a silhueta.',
                'display_order' => 1,
            ],
            [
                'name' => 'Regular',
                'slug' => 'regular',
                'description' => 'Caimento padrao, equilibrado entre conforto e forma.',
                'display_order' => 2,
            ],
            [
                'name' => 'Oversized',
                'slug' => 'oversized',
                'description' => 'Modelagem larga e solta, inspirada no streetwear.',
                'display_order' => 3,
            ],
            [
                'name' => 'Relaxed',
                'slug' => 'relaxed',
                'description' => 'Mais folgado que o regular, priorizando conforto.',
                'display_order' => 4,
            ],
            [
                'name' => 'Skinny',
                'slug' => 'skinny',
                'description' => 'Extremamente ajustado, comum em calcas e jeans.',
                'display_order' => 5,
            ],
            [
                'name' => 'Tailored',
                'slug' => 'tailored',
                'description' => 'Ajuste sob medida, comum em alfaiataria.',
                'display_order' => 6,
            ],
        ];

        foreach ($fits as $fit) {
            DB::table('fits')->updateOrInsert(
                ['slug' => $fit['slug']],
                [
                    'name' => $fit['name'],
                    'description' => $fit['description'],
                    'is_active' => true,
                    'display_order' => $fit['display_order'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Fits seeded: 6 fit types');
    }
}
