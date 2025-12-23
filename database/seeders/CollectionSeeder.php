<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $collections = [
            // EVENTOS ESPECIAIS
            ['name' => 'Réveillon 2025', 'slug' => 'reveillon-2025', 'description' => 'Coleção exclusiva para a passagem de ano em Angola.', 'year' => 2025, 'season' => 'special', 'launch_date' => '2025-12-05', 'end_date' => '2026-01-05', 'image_path' => null, 'is_active' => true, 'is_featured' => true, 'display_order' => 1, 'meta_title' => 'Réveillon 2025 Angola - Vestidos de Festa | Teu Estilo', 'meta_description' => 'Looks deslumbrantes para a virada do ano.'],
            ['name' => 'Natal 2025', 'slug' => 'natal-2025', 'description' => 'Coleção de Natal com vestidos festivos.', 'year' => 2025, 'season' => 'special', 'launch_date' => '2025-11-15', 'end_date' => '2025-12-26', 'image_path' => null, 'is_active' => false, 'is_featured' => true, 'display_order' => 2, 'meta_title' => 'Natal 2025 Angola - Vestidos Festivos | Teu Estilo', 'meta_description' => 'Roupas de Natal em Luanda.'],
            ['name' => 'Dia dos Namorados 2026', 'slug' => 'dia-namorados-2026', 'description' => 'Coleção romântica para o Dia dos Namorados.', 'year' => 2026, 'season' => 'special', 'launch_date' => '2026-01-20', 'end_date' => '2026-02-15', 'image_path' => null, 'is_active' => false, 'is_featured' => true, 'display_order' => 3, 'meta_title' => 'Dia dos Namorados 2026 Angola | Teu Estilo', 'meta_description' => 'Peças românticas para o Dia dos Namorados.'],
            ['name' => 'Dia da Mulher 2026', 'slug' => 'dia-mulher-2026', 'description' => 'Coleção especial para o Dia Internacional da Mulher.', 'year' => 2026, 'season' => 'special', 'launch_date' => '2026-02-20', 'end_date' => '2026-03-10', 'image_path' => null, 'is_active' => false, 'is_featured' => true, 'display_order' => 4, 'meta_title' => 'Dia da Mulher 2026 Angola | Teu Estilo', 'meta_description' => 'Celebre o Dia da Mulher com estilo.'],
            ['name' => 'Dia das Mães 2026', 'slug' => 'dia-maes-2026', 'description' => 'Coleção para celebrar as mães angolanas.', 'year' => 2026, 'season' => 'special', 'launch_date' => '2026-04-20', 'end_date' => '2026-05-15', 'image_path' => null, 'is_active' => false, 'is_featured' => false, 'display_order' => 5, 'meta_title' => 'Dia das Mães 2026 Angola | Teu Estilo', 'meta_description' => 'Presentes especiais para o Dia das Mães.'],
            ['name' => 'Halloween 2026', 'slug' => 'halloween-2026', 'description' => 'Coleção Halloween com peças góticas e criativas.', 'year' => 2026, 'season' => 'special', 'launch_date' => '2026-10-01', 'end_date' => '2026-11-01', 'image_path' => null, 'is_active' => false, 'is_featured' => false, 'display_order' => 6, 'meta_title' => 'Halloween 2026 Angola | Teu Estilo', 'meta_description' => 'Looks para festas de Halloween.'],
            
            // SAZONAIS
            ['name' => 'Verão 2025', 'slug' => 'verao-2025', 'description' => 'Coleção de verão com peças leves e coloridas.', 'year' => 2025, 'season' => 'spring_summer', 'launch_date' => '2024-12-01', 'end_date' => '2025-04-30', 'image_path' => null, 'is_active' => true, 'is_featured' => false, 'display_order' => 7, 'meta_title' => 'Verão 2025 Angola - Moda Leve | Teu Estilo', 'meta_description' => 'Moda de verão em Luanda.'],
            ['name' => 'Primavera 2025', 'slug' => 'primavera-2025', 'description' => 'Coleção de primavera com cores vibrantes.', 'year' => 2025, 'season' => 'spring_summer', 'launch_date' => '2025-09-01', 'end_date' => '2025-11-30', 'image_path' => null, 'is_active' => false, 'is_featured' => false, 'display_order' => 8, 'meta_title' => 'Primavera 2025 Angola | Teu Estilo', 'meta_description' => 'Moda de primavera em Luanda.'],
            ['name' => 'Inverno Leve 2025', 'slug' => 'inverno-2025', 'description' => 'Coleção para noites frescas de Angola.', 'year' => 2025, 'season' => 'fall_winter', 'launch_date' => '2025-05-01', 'end_date' => '2025-08-31', 'image_path' => null, 'is_active' => false, 'is_featured' => false, 'display_order' => 9, 'meta_title' => 'Inverno Leve 2025 Angola | Teu Estilo', 'meta_description' => 'Roupas para noites frescas.'],
            
            // TEMÁTICAS
            ['name' => 'Back to Work', 'slug' => 'back-to-work', 'description' => 'Coleção profissional para o trabalho.', 'year' => 2025, 'season' => 'all_year', 'launch_date' => '2024-12-20', 'end_date' => '2025-12-31', 'image_path' => null, 'is_active' => true, 'is_featured' => false, 'display_order' => 10, 'meta_title' => 'Moda Trabalho Angola | Teu Estilo', 'meta_description' => 'Roupas profissionais em Luanda.'],
            ['name' => 'Back to School', 'slug' => 'back-to-school', 'description' => 'Coleção para estudantes.', 'year' => 2025, 'season' => 'all_year', 'launch_date' => '2024-12-20', 'end_date' => '2025-12-31', 'image_path' => null, 'is_active' => true, 'is_featured' => false, 'display_order' => 11, 'meta_title' => 'Moda Escola Angola | Teu Estilo', 'meta_description' => 'Roupas para escola e universidade.'],
            ['name' => 'Férias na Praia', 'slug' => 'ferias-praia', 'description' => 'Coleção para as férias na praia.', 'year' => 2025, 'season' => 'spring_summer', 'launch_date' => '2024-12-01', 'end_date' => '2025-03-31', 'image_path' => null, 'is_active' => true, 'is_featured' => true, 'display_order' => 12, 'meta_title' => 'Férias Praia Angola | Teu Estilo', 'meta_description' => 'Moda praia em Angola.'],
            ['name' => 'Noite Glamorosa', 'slug' => 'noite-glamorosa', 'description' => 'Coleção para eventos noturnos.', 'year' => 2025, 'season' => 'all_year', 'launch_date' => '2024-12-20', 'end_date' => '2025-12-31', 'image_path' => null, 'is_active' => true, 'is_featured' => false, 'display_order' => 13, 'meta_title' => 'Looks Noite Angola | Teu Estilo', 'meta_description' => 'Looks glamorosos para festas.'],
            ['name' => 'Convidada Especial', 'slug' => 'convidada-casamento', 'description' => 'Coleção para convidadas de casamento.', 'year' => 2025, 'season' => 'all_year', 'launch_date' => '2024-12-20', 'end_date' => '2025-12-31', 'image_path' => null, 'is_active' => true, 'is_featured' => false, 'display_order' => 14, 'meta_title' => 'Looks Casamento Angola | Teu Estilo', 'meta_description' => 'Vestidos para convidadas de casamento.'],
            ['name' => 'Maternidade Chic', 'slug' => 'maternidade-chic', 'description' => 'Coleção para grávidas.', 'year' => 2025, 'season' => 'all_year', 'launch_date' => '2024-12-20', 'end_date' => '2025-12-31', 'image_path' => null, 'is_active' => false, 'is_featured' => false, 'display_order' => 15, 'meta_title' => 'Moda Gestante Angola | Teu Estilo', 'meta_description' => 'Roupas para grávidas em Luanda.'],
        ];

        foreach ($collections as $collection) {
            DB::table('collections')->updateOrInsert(
                ['slug' => $collection['slug']], // Chave única
                [
                    'name' => $collection['name'],
                    'description' => $collection['description'],
                    'year' => $collection['year'],
                    'season' => $collection['season'],
                    'launch_date' => $collection['launch_date'],
                    'end_date' => $collection['end_date'],
                    'image_path' => $collection['image_path'],
                    'is_active' => $collection['is_active'],
                    'is_featured' => $collection['is_featured'],
                    'display_order' => $collection['display_order'],
                    'meta_title' => $collection['meta_title'],
                    'meta_description' => $collection['meta_description'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Collections seeded: 15 collections (5 active, 7 featured)');
    }
}