<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CollectionSeeder extends Seeder
{
    /**
     * Seed the collections table with initial seasonal collections.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('collections')->insert([
            
            // ========================================
            // COLEÇÕES DE EVENTOS ESPECIAIS
            // ========================================
          
            [
                'name' => 'Réveillon 2025',
                'slug' => 'reveillon-2025',
                'description' => 'Coleção exclusiva para a passagem de ano em Angola. Vestidos glamorosos, acessórios brilhantes e looks deslumbrantes para celebrar 2025 com estilo.',
                'year' => 2025,
                'season' => 'special',
                'launch_date' => '2025-12-05', // ✅ Já lançada
                'end_date' => '2026-01-05',    // ✅ Termina em Jan/2025
                'image_path' => null,
                'is_active' => true,
                'is_featured' => true,
                'display_order' => 1,
                'meta_title' => 'Réveillon 2025 Angola - Vestidos de Festa | Teu Estilo',
                'meta_description' => 'Looks deslumbrantes para a virada do ano: vestidos glamorosos, acessórios brilhantes e muito estilo. Celebre 2025 com elegância. Compre já!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Natal 2025',  // ⬅️ MUDOU: 2024 → 2025
                'slug' => 'natal-2025',  // ⬅️ MUDOU
                'description' => 'Coleção de Natal com vestidos festivos, conjuntos elegantes e acessórios perfeitos para as celebrações de fim de ano.',
                'year' => 2025,  // ⬅️ MUDOU: 2024 → 2025
                'season' => 'special',
                'launch_date' => '2025-11-15',  // ⬅️ MUDOU: Nov/2025
                'end_date' => '2025-12-26',      // ⬅️ MUDOU: Dez/2025
                'image_path' => null,
                'is_active' => false,  // ⬅️ MUDOU: Ativa só em Nov/2025
                'is_featured' => true,
                'display_order' => 2,
                'meta_title' => 'Natal 2025 Angola - Vestidos Festivos | Teu Estilo',  // ⬅️ MUDOU
                'meta_description' => 'Roupas de Natal em Luanda: vestidos festivos, conjuntos elegantes e acessórios brilhantes. Celebre com estilo e conforto. Entrega rápida!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Dia dos Namorados 2026',  // ⬅️ MUDOU: 2025 → 2026
                'slug' => 'dia-namorados-2026',      // ⬅️ MUDOU
                'description' => 'Coleção romântica para o Dia dos Namorados em Angola. Vestidos sensuais, lingerie elegante e peças em tons de vermelho e rosa.',
                'year' => 2026,  // ⬅️ MUDOU: 2025 → 2026
                'season' => 'special',
                'launch_date' => '2026-01-20',  // ⬅️ MUDOU: Jan/2026
                'end_date' => '2026-02-15',      // ⬅️ MUDOU: Fev/2026
                'image_path' => null,
                'is_active' => false,  // ⬅️ MUDOU: Ativa em Jan/2026
                'is_featured' => true,
                'display_order' => 3,
                'meta_title' => 'Dia dos Namorados 2026 Angola - Looks Românticos | Teu Estilo',  // ⬅️ MUDOU
                'meta_description' => 'Peças românticas para o Dia dos Namorados em Luanda: vestidos sensuais, lingerie elegante e acessórios apaixonantes. Surpreenda seu amor. Compre online!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Dia da Mulher 2026',  // ⬅️ MUDOU: 2025 → 2026
                'slug' => 'dia-mulher-2026',     // ⬅️ MUDOU
                'description' => 'Coleção especial para o Dia Internacional da Mulher. Peças empoderadoras, elegantes e cheias de atitude para celebrar a força feminina.',
                'year' => 2026,  // ⬅️ MUDOU: 2025 → 2026
                'season' => 'special',
                'launch_date' => '2026-02-20',  // ⬅️ MUDOU: Fev/2026
                'end_date' => '2026-03-10',      // ⬅️ MUDOU: Mar/2026
                'image_path' => null,
                'is_active' => false,
                'is_featured' => true,
                'display_order' => 4,
                'meta_title' => 'Dia da Mulher 2026 Angola - Moda Feminina | Teu Estilo',  // ⬅️ MUDOU
                'meta_description' => 'Celebre o Dia da Mulher com estilo em Luanda! Vestidos elegantes, conjuntos empoderados e acessórios especiais. Você merece o melhor. Compre já!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Dia das Mães 2026',  // ⬅️ MUDOU: 2025 → 2026
                'slug' => 'dia-maes-2026',      // ⬅️ MUDOU
                'description' => 'Coleção pensada para celebrar as mães angolanas. Peças confortáveis, elegantes e versáteis para o dia mais especial do ano.',
                'year' => 2026,  // ⬅️ MUDOU: 2025 → 2026
                'season' => 'special',
                'launch_date' => '2026-04-20',  // ⬅️ MUDOU: Abr/2026
                'end_date' => '2026-05-15',      // ⬅️ MUDOU: Mai/2026
                'image_path' => null,
                'is_active' => false,
                'is_featured' => false,
                'display_order' => 5,
                'meta_title' => 'Dia das Mães 2026 Angola - Presentes Especiais | Teu Estilo',  // ⬅️ MUDOU
                'meta_description' => 'Presentes especiais para o Dia das Mães em Luanda: vestidos elegantes, acessórios sofisticados e roupas confortáveis. Surpreenda sua mãe. Compre online!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Halloween 2026',  // ⬅️ MUDOU: 2025 → 2026
                'slug' => 'halloween-2026',  // ⬅️ MUDOU
                'description' => 'Coleção Halloween com peças góticas, pretas, sensuais e criativas. Looks perfeitos para festas temáticas e eventos noturnos.',
                'year' => 2026,  // ⬅️ MUDOU: 2025 → 2026
                'season' => 'special',
                'launch_date' => '2026-10-01',  // ⬅️ MUDOU: Out/2026
                'end_date' => '2026-11-01',      // ⬅️ MUDOU: Nov/2026
                'image_path' => null,
                'is_active' => false,
                'is_featured' => false,
                'display_order' => 6,
                'meta_title' => 'Halloween 2026 Angola - Looks de Festa | Teu Estilo',  // ⬅️ MUDOU
                'meta_description' => 'Looks para festas de Halloween em Luanda: peças góticas, vestidos pretos sensuais e acessórios criativos. Surpreenda na festa. Compre já!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // ========================================
            // COLEÇÕES SAZONAIS
            // ========================================
            
            [
                'name' => 'Verão 2025',
                'slug' => 'verao-2025',
                'description' => 'Coleção de verão com peças leves, frescas, coloridas e respiráveis. Perfeitas para o clima quente de Angola.',
                'year' => 2025,
                'season' => 'spring_summer',
                'launch_date' => '2024-12-01',  // ✅ Já lançada (Dez/2024)
                'end_date' => '2025-04-30',      // ✅ Termina Abr/2025
                'image_path' => null,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 7,
                'meta_title' => 'Verão 2025 Angola - Moda Leve e Fresca | Teu Estilo',
                'meta_description' => 'Moda de verão em Luanda: vestidos leves, shorts frescos, blusas coloridas e sandálias confortáveis. Perfeitas para o calor angolano. Compre online!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Primavera 2025',
                'slug' => 'primavera-2025',
                'description' => 'Coleção de primavera com cores vibrantes, estampas florais e peças delicadas. Renove seu guarda-roupa com frescor.',
                'year' => 2025,
                'season' => 'spring_summer',
                'launch_date' => '2025-09-01',  // ✅ Set/2025
                'end_date' => '2025-11-30',      // ✅ Nov/2025
                'image_path' => null,
                'is_active' => false,
                'is_featured' => false,
                'display_order' => 8,
                'meta_title' => 'Primavera 2025 Angola - Cores e Florais | Teu Estilo',
                'meta_description' => 'Moda de primavera em Luanda: estampas florais, cores vibrantes e peças delicadas. Renove seu visual com frescor e estilo. Compre já!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Inverno Leve 2025',
                'slug' => 'inverno-2025',
                'description' => 'Coleção para noites frescas de Angola. Casacos leves, cardigans, blusas de manga comprida e calças confortáveis.',
                'year' => 2025,
                'season' => 'fall_winter',
                'launch_date' => '2025-05-01',  // ✅ Mai/2025
                'end_date' => '2025-08-31',      // ✅ Ago/2025
                'image_path' => null,
                'is_active' => false,
                'is_featured' => false,
                'display_order' => 9,
                'meta_title' => 'Inverno Leve 2025 Angola - Casacos e Cardigans | Teu Estilo',
                'meta_description' => 'Roupas para noites frescas em Luanda: casacos leves, cardigans elegantes e blusas confortáveis. Estilo e conforto. Compre online!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            // ========================================
            // COLEÇÕES TEMÁTICAS (Ocasiões - Ano Todo)
            // ========================================
            
            [
                'name' => 'Back to Work',
                'slug' => 'back-to-work',
                'description' => 'Coleção profissional para o ambiente de trabalho. Blazers, calças de alfaiataria, blusas elegantes e acessórios sofisticados.',
                'year' => 2025,
                'season' => 'all_year',
                'launch_date' => '2024-12-20',  // ⬅️ MUDOU: Lança agora (Dez/2024)
                'end_date' => '2025-12-31',      // ✅ Todo 2025
                'image_path' => null,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 10,
                'meta_title' => 'Moda Trabalho Angola - Looks Profissionais | Teu Estilo',
                'meta_description' => 'Roupas profissionais em Luanda: blazers elegantes, calças de alfaiataria, blusas sofisticadas. Estilo e credibilidade no trabalho. Compre online!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Back to School',
                'slug' => 'back-to-school',
                'description' => 'Coleção para estudantes. Peças práticas, confortáveis e estilosas para a escola e universidade.',
                'year' => 2025,
                'season' => 'all_year',
                'launch_date' => '2024-12-20',  // ⬅️ MUDOU: Lança agora (Dez/2024)
                'end_date' => '2025-12-31',      // ✅ Todo 2025
                'image_path' => null,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 11,
                'meta_title' => 'Moda Escola Angola - Looks Universitários | Teu Estilo',
                'meta_description' => 'Roupas para escola e universidade em Luanda: jeans confortáveis, blusas práticas, mochilas e tênis. Estilo jovem e acessível. Compre já!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Férias na Praia',
                'slug' => 'ferias-praia',
                'description' => 'Coleção para as férias. Biquínis, saídas de praia, vestidos leves, chapéus e óculos de sol. Aproveite o verão angolano.',
                'year' => 2025,
                'season' => 'spring_summer',
                'launch_date' => '2024-12-01',  // ✅ Já lançada (Dez/2024)
                'end_date' => '2025-03-31',      // ✅ Mar/2025
                'image_path' => null,
                'is_active' => true,
                'is_featured' => true,
                'display_order' => 12,
                'meta_title' => 'Férias Praia Angola - Biquínis e Saídas | Teu Estilo',
                'meta_description' => 'Moda praia em Angola: biquínis modernos, saídas elegantes, vestidos leves e acessórios. Aproveite o sol com estilo. Entrega em Luanda!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Noite Glamorosa',
                'slug' => 'noite-glamorosa',
                'description' => 'Coleção para eventos noturnos e festas. Vestidos de gala, saltos altos, clutches e jóias brilhantes.',
                'year' => 2025,
                'season' => 'all_year',
                'launch_date' => '2024-12-20',  // ⬅️ MUDOU: Lança agora (Dez/2024)
                'end_date' => '2025-12-31',      // ✅ Todo 2025
                'image_path' => null,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 13,
                'meta_title' => 'Looks Noite Angola - Vestidos de Gala | Teu Estilo',
                'meta_description' => 'Looks glamorosos para festas em Luanda: vestidos de gala, saltos elegantes, clutches sofisticadas. Brilhe na noite. Compre online!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Convidada Especial',
                'slug' => 'convidada-casamento',
                'description' => 'Coleção para convidadas de casamento. Vestidos midi, longos, acessórios delicados e sapatos elegantes.',
                'year' => 2025,
                'season' => 'all_year',
                'launch_date' => '2024-12-20',  // ⬅️ MUDOU: Lança agora (Dez/2024)
                'end_date' => '2025-12-31',      // ✅ Todo 2025
                'image_path' => null,
                'is_active' => true,
                'is_featured' => false,
                'display_order' => 14,
                'meta_title' => 'Looks Casamento Angola - Convidada Elegante | Teu Estilo',
                'meta_description' => 'Vestidos para convidadas de casamento em Luanda: looks midi e longos, acessórios delicados e sapatos elegantes. Esteja impecável. Compre já!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'name' => 'Maternidade Chic',
                'slug' => 'maternidade-chic',
                'description' => 'Coleção para grávidas. Vestidos confortáveis, blusas amplas, calças com elástico e peças que crescem com a barriga.',
                'year' => 2025,
                'season' => 'all_year',
                'launch_date' => '2024-12-20',  // ⬅️ MUDOU: Lança agora (Dez/2024)
                'end_date' => '2025-12-31',      // ✅ Todo 2025
                'image_path' => null,
                'is_active' => false,  // ⬅️ MUDOU: Ativa depois (menos prioritária)
                'is_featured' => false,
                'display_order' => 15,
                'meta_title' => 'Moda Gestante Angola - Roupas Grávidas | Teu Estilo',
                'meta_description' => 'Roupas para grávidas em Luanda: vestidos confortáveis, blusas amplas e calças especiais. Estilo e conforto na gravidez. Compre online!',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
        ]);

        $this->command->info('✅ Collections seeded: 15 collections (5 active now, 7 featured)');

    }
}
