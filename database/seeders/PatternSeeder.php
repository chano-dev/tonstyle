<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatternSeeder extends Seeder
{
    /**
     * Seed the patterns table.
     * Print and texture types applicable across product categories.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $patterns = [
            [
                'name' => 'Liso',
                'slug' => 'liso',
                'description' => 'Sem estampas ou texturas visíveis — cor uniforme.',
                'display_order' => 1,
            ],
            [
                'name' => 'Floral',
                'slug' => 'floral',
                'description' => 'Estampas com flores, desde delicadas a tropicais.',
                'display_order' => 2,
            ],
            [
                'name' => 'Listras',
                'slug' => 'listras',
                'description' => 'Linhas verticais, horizontais ou diagonais.',
                'display_order' => 3,
            ],
            [
                'name' => 'Animal Print',
                'slug' => 'animal-print',
                'description' => 'Padrões inspirados em peles animais: onça, zebra, cobra, etc.',
                'display_order' => 4,
            ],
            [
                'name' => 'Xadrez',
                'slug' => 'xadrez',
                'description' => 'Padrão quadriculado em cores contrastantes.',
                'display_order' => 5,
            ],
            [
                'name' => 'Pois',
                'slug' => 'pois',
                'description' => 'Círculos repetidos, também conhecido como “bolinhas”.',
                'display_order' => 6,
            ],
            [
                'name' => 'Geométrico',
                'slug' => 'geometrico',
                'description' => 'Formas como triângulos, losangos, hexágonos ou abstrações.',
                'display_order' => 7,
            ],
            [
                'name' => 'Tie-Dye',
                'slug' => 'tie-dye',
                'description' => 'Efeito degradê colorido, com transições fluidas entre cores.',
                'display_order' => 8,
            ],
            [
                'name' => 'Tecido Nacional',
                'slug' => 'tecido-nacional',
                'description' => 'Padrões tradicionais angolanos ou africanos (ex: capulana).',
                'display_order' => 9,
            ],
            [
                'name' => 'Abstrato',
                'slug' => 'abstrato',
                'description' => 'Desenhos não figurativos, com pinceladas ou formas livres.',
                'display_order' => 10,
            ],
            [
                'name' => 'Camuflado',
                'slug' => 'camuflado',
                'description' => 'Padrão militar com tons verdes, castanhos ou urbanos.',
                'display_order' => 11,
            ],
            [
                'name' => 'Multicolor',
                'slug' => 'multicolor',
                'description' => 'Combinação vibrante de várias cores sem padrão fixo.',
                'display_order' => 12,
            ],
        ];

        foreach ($patterns as $pattern) {
            DB::table('patterns')->updateOrInsert(['slug' => $pattern['slug']],
            [
                'name' => $pattern['name'],
                'description' => $pattern['description'],
                'is_active' => true,
                'display_order' => $pattern['display_order'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Patterns seeded: 12 patterns (Liso, Floral, Listras, Animal Print, Xadrez, Pois, Geométrico, Tie-Dye, Tecido Nacional, Abstrato, Camuflado, Multicolor)');
    }
}