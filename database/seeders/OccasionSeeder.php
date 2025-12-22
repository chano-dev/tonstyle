<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OccasionSeeder extends Seeder
{
    /**
     * Seed the occasions table.
     * Covers all product categories: clothing, footwear, accessories, cosmetics, etc.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $occasions = [
            [
                'name' => 'Dia a Dia',
                'slug' => 'dia-a-dia',
                'description' => 'Peças e produtos para uso cotidiano, confortáveis e práticos.',
                'icon' => 'fas fa-home',
                'display_order' => 1,
            ],
            [
                'name' => 'Trabalho',
                'slug' => 'trabalho',
                'description' => 'Looks profissionais, formais ou business casual para o ambiente corporativo.',
                'icon' => 'fas fa-briefcase',
                'display_order' => 2,
            ],
            [
                'name' => 'Festa',
                'slug' => 'festa',
                'description' => 'Itens para celebrações noturnas, festas e eventos festivos.',
                'icon' => 'fas fa-glass-whiskey',
                'display_order' => 3,
            ],
            [
                'name' => 'Casamento',
                'slug' => 'casamento',
                'description' => 'Roupas, acessórios e cosméticos para núpcias — convidados ou noivos.',
                'icon' => 'fas fa-ring',
                'display_order' => 4,
            ],
            [
                'name' => 'Igreja',
                'slug' => 'igreja',
                'description' => 'Looks modestos e elegantes para cultos e cerimónias religiosas.',
                'icon' => 'fas fa-church',
                'display_order' => 5,
            ],
            [
                'name' => 'Praia',
                'slug' => 'praia',
                'description' => 'Moda praiana: biquínis, roupas leves, chapéus, protetor solar, etc.',
                'icon' => 'fas fa-umbrella-beach',
                'display_order' => 6,
            ],
            [
                'name' => 'Esporte',
                'slug' => 'esporte',
                'description' => 'Vestuário e acessórios para atividade física e lazer ativo.',
                'icon' => 'fas fa-running',
                'display_order' => 7,
            ],
            [
                'name' => 'Romance',
                'slug' => 'romance',
                'description' => 'Peças sedutoras ou elegantes para encontros especiais.',
                'icon' => 'fas fa-heart',
                'display_order' => 8,
            ],
            [
                'name' => 'Viagem',
                'slug' => 'viagem',
                'description' => 'Itens práticos e versáteis para usar em deslocamentos e turismo.',
                'icon' => 'fas fa-suitcase',
                'display_order' => 9,
            ],
            [
                'name' => 'Formal',
                'slug' => 'formal',
                'description' => 'Looks elegantes para cerimónias, coquetéis e eventos solenes.',
                'icon' => 'fas fa-vest',
                'display_order' => 10,
            ],
        ];

        foreach ($occasions as $occasion) {
            DB::table('occasions')->updateOrInsert(['slug' => $occasion['slug']],
            [
                'name' => $occasion['name'],
                'description' => $occasion['description'],
                'icon' => $occasion['icon'],
                'is_active' => true,
                'display_order' => $occasion['display_order'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Occasions seeded: 10 occasions (Dia a Dia, Trabalho, Festa, Casamento, Igreja, Praia, Esporte, Romance, Viagem, Formal)');
    }
}