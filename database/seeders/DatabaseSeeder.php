<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        // JÁ FORAM EXECUTADOS PHP ARTISAN DB:SEED
            SegmentSeeder::class,
            CategorieSeeder::class,
            SupplierSeeder::class,
            BrandSeeder::class,
            CollectionSeeder::class,
            ProfessionalSeeder::class,

            // Seeders de Tabelas Essênias (subcategoria; cores; tamanhos; material; tipo de corpo);
            SubcategorySeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            MaterialSeeder::class,
            BodyTypeSeeder::class,

            // Seeders de Tabelas de Filtros (ocasião; estilo; padrões);
            OccasionSeeder::class,
            StyleSeeder::class,
            PatternSeeder::class,

            // Seeders de Tabelas de Filtros (Fit; Comprimento; Gola; Mangas: Fecho; Instruções de cuidado; certificados);
            FitSeeder::class,
            LengthSeeder::class,
            NecklineSeeder::class,
            SleeveSeeder::class,
            ClosureSeeder::class,
            CareInstructionSeeder::class,
            CertificationSeeder::class,

        ]);
    }
}
