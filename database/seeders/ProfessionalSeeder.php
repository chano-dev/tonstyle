<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProfessionalSeeder extends Seeder
{
    public function run(): void
    {
        // Ainda sem dados - profissionais serão adicionados manualmente
        $this->command->info('⏸️ ProfessionalSeeder: Nenhum profissional adicionado (futuro)');
    }
}