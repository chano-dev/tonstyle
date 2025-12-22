<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CareInstructionSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $instructions = [
            // Washing
            ['name' => 'Lavar a mao', 'slug' => 'lavar-a-mao', 'instruction_type' => 'washing', 'icon' => 'hand-wash', 'description' => 'Recomendado para tecidos delicados e bijuteria.', 'display_order' => 1],
            ['name' => 'Maquina 30c', 'slug' => 'maquina-30c', 'instruction_type' => 'washing', 'icon' => 'wash-30', 'description' => 'Lavagem em ciclo suave ate 30 graus.', 'display_order' => 2],
            ['name' => 'Nao lavar', 'slug' => 'nao-lavar', 'instruction_type' => 'washing', 'icon' => 'do-not-wash', 'description' => 'Limpeza apenas a seco ou especifica.', 'display_order' => 3],

            // Drying
            ['name' => 'Secar ao ar', 'slug' => 'secar-ao-ar', 'instruction_type' => 'drying', 'icon' => 'air-dry', 'description' => 'Evitar maquina de secar.', 'display_order' => 4],
            ['name' => 'Nao usar secadora', 'slug' => 'nao-usar-secadora', 'instruction_type' => 'drying', 'icon' => 'no-tumble-dry', 'description' => 'Pode danificar fibras ou acabamentos.', 'display_order' => 5],

            // Ironing
            ['name' => 'Passar baixa temperatura', 'slug' => 'passar-baixa-temp', 'instruction_type' => 'ironing', 'icon' => 'iron-low', 'description' => 'Ate 110 graus.', 'display_order' => 6],
            ['name' => 'Nao passar', 'slug' => 'nao-passar', 'instruction_type' => 'ironing', 'icon' => 'do-not-iron', 'description' => 'Pode danificar o produto.', 'display_order' => 7],

            // Storage
            ['name' => 'Guardar em local seco', 'slug' => 'guardar-local-seco', 'instruction_type' => 'storage', 'icon' => 'store-dry', 'description' => 'Evitar humidade e calor.', 'display_order' => 8],
            ['name' => 'Evitar sol direto', 'slug' => 'evitar-sol-direto', 'instruction_type' => 'storage', 'icon' => 'no-sun', 'description' => 'Previne desbotamento e degradacao.', 'display_order' => 9],

            // Usage
            ['name' => 'Evitar contato com agua', 'slug' => 'evitar-agua', 'instruction_type' => 'usage', 'icon' => 'no-water', 'description' => 'Especialmente para bijuteria e cosmeticos.', 'display_order' => 10],
            ['name' => 'Uso externo', 'slug' => 'uso-externo', 'instruction_type' => 'usage', 'icon' => 'external-use', 'description' => 'Nao ingerir ou aplicar internamente.', 'display_order' => 11],

            // Expiry
            ['name' => 'Validade apos abertura', 'slug' => 'validade-apos-abertura', 'instruction_type' => 'expiry', 'icon' => 'expiry', 'description' => 'Cosmeticos devem ser usados dentro do prazo.', 'display_order' => 12],

            // Other
            ['name' => 'Limpeza profissional', 'slug' => 'limpeza-profissional', 'instruction_type' => 'other', 'icon' => 'dry-clean', 'description' => 'Recomendado para itens sensiveis.', 'display_order' => 13],
        ];

        foreach ($instructions as $item) {
            DB::table('care_instructions')->updateOrInsert(
                ['slug' => $item['slug']],
                [
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'icon' => $item['icon'],
                    'instruction_type' => $item['instruction_type'],
                    'is_active' => true,
                    'display_order' => $item['display_order'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Care Instructions seeded: washing, drying, ironing, storage, usage, expiry');
    }
}
