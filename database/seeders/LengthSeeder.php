<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LengthSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $lengths = [
            [
                'name' => 'Curto',
                'slug' => 'curto',
                'description' => 'Comprimento acima do padrao, curto ou cropped.',
                'display_order' => 1,
            ],
            [
                'name' => 'Medio',
                'slug' => 'medio',
                'description' => 'Comprimento intermediario.',
                'display_order' => 2,
            ],
            [
                'name' => 'Longo',
                'slug' => 'longo',
                'description' => 'Comprimento abaixo do padrao, longo ou maxi.',
                'display_order' => 3,
            ],
            [
                'name' => 'Extra Longo',
                'slug' => 'extra-longo',
                'description' => 'Comprimento estendido, acima do convencional.',
                'display_order' => 4,
            ],
            [
                'name' => 'Cropped',
                'slug' => 'cropped',
                'description' => 'Comprimento reduzido, acima da cintura.',
                'display_order' => 5,
            ],
        ];

        foreach ($lengths as $length) {
            DB::table('lengths')->updateOrInsert(
                ['slug' => $length['slug']],
                [
                    'name' => $length['name'],
                    'description' => $length['description'],
                    'is_active' => true,
                    'display_order' => $length['display_order'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Lengths seeded: 5 length types');
    }
}
