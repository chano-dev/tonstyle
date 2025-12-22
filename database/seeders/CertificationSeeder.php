<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CertificationSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $certifications = [
            ['name' => 'Organico', 'slug' => 'organico', 'certification_type' => 'eco', 'icon' => 'leaf', 'description' => 'Materia prima cultivada sem pesticidas.', 'display_order' => 1],
            ['name' => 'Sustentavel', 'slug' => 'sustentavel', 'certification_type' => 'eco', 'icon' => 'recycle', 'description' => 'Processos com baixo impacto ambiental.', 'display_order' => 2],
            ['name' => 'Cruelty Free', 'slug' => 'cruelty-free', 'certification_type' => 'animal', 'icon' => 'paw', 'description' => 'Nao testado em animais.', 'display_order' => 3],
            ['name' => 'Vegan', 'slug' => 'vegan', 'certification_type' => 'animal', 'icon' => 'seedling', 'description' => 'Sem ingredientes de origem animal.', 'display_order' => 4],
            ['name' => 'Dermatologicamente Testado', 'slug' => 'dermatologicamente-testado', 'certification_type' => 'health', 'icon' => 'check', 'description' => 'Seguro para uso na pele.', 'display_order' => 5],
            ['name' => 'Alta Qualidade', 'slug' => 'alta-qualidade', 'certification_type' => 'quality', 'icon' => 'award', 'description' => 'Padrao elevado de acabamento e durabilidade.', 'display_order' => 6],
            ['name' => 'Feito em Angola', 'slug' => 'feito-em-angola', 'certification_type' => 'origin', 'icon' => 'flag', 'description' => 'Produto de origem nacional.', 'display_order' => 7],
            ['name' => 'Importado', 'slug' => 'importado', 'certification_type' => 'origin', 'icon' => 'globe', 'description' => 'Produto de origem internacional.', 'display_order' => 8],
        ];

        foreach ($certifications as $cert) {
            DB::table('certifications')->updateOrInsert(
                ['slug' => $cert['slug']],
                [
                    'name' => $cert['name'],
                    'description' => $cert['description'],
                    'icon' => $cert['icon'],
                    'certification_type' => $cert['certification_type'],
                    'is_active' => true,
                    'display_order' => $cert['display_order'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Certifications seeded: eco, animal, health, quality, origin');
    }
}
