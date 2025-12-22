<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ColorSeeder extends Seeder
{
    /**
     * Seed the colors table.
     * Includes base colors + light/dark variations
     * Organized by color families for better UX
     */
    public function run(): void
    {
        $now = Carbon::now();

        $colors = [
            // === NEUTROS ===
            ['name' => 'Branco', 'hex_code' => '#FFFFFF', 'display_order' => 1],
            ['name' => 'Branco Gelo', 'hex_code' => '#F8F8FF', 'display_order' => 2],
            ['name' => 'Creme', 'hex_code' => '#FFFDD0', 'display_order' => 3],
            ['name' => 'Bege', 'hex_code' => '#F5F5DC', 'display_order' => 4],
            ['name' => 'Bege Escuro', 'hex_code' => '#D2B48C', 'display_order' => 5],
            ['name' => 'Castanho Claro', 'hex_code' => '#D2691E', 'display_order' => 6],
            ['name' => 'Castanho', 'hex_code' => '#8B4513', 'display_order' => 7],
            ['name' => 'Castanho Escuro', 'hex_code' => '#5C4033', 'display_order' => 8],
            ['name' => 'Caramelo', 'hex_code' => '#FFD59A', 'display_order' => 9],
            ['name' => 'Chocolate', 'hex_code' => '#7B3F00', 'display_order' => 10],
            ['name' => 'Nude', 'hex_code' => '#E3BC9A', 'display_order' => 11],
            
            // === PRETOS E CINZAS ===
            ['name' => 'Preto', 'hex_code' => '#000000', 'display_order' => 12],
            ['name' => 'Cinza Claro', 'hex_code' => '#D3D3D3', 'display_order' => 13],
            ['name' => 'Cinza', 'hex_code' => '#808080', 'display_order' => 14],
            ['name' => 'Cinza Escuro', 'hex_code' => '#404040', 'display_order' => 15],
            ['name' => 'Cinza Chumbo', 'hex_code' => '#36454F', 'display_order' => 16],
            ['name' => 'Prata', 'hex_code' => '#C0C0C0', 'display_order' => 17],
            ['name' => 'Carvão', 'hex_code' => '#36454F', 'display_order' => 18],
            
            // === VERMELHOS ===
            ['name' => 'Vermelho', 'hex_code' => '#FF0000', 'display_order' => 19],
            ['name' => 'Vermelho Claro', 'hex_code' => '#FF6B6B', 'display_order' => 20],
            ['name' => 'Vermelho Escuro', 'hex_code' => '#8B0000', 'display_order' => 21],
            ['name' => 'Vermelho Vinho', 'hex_code' => '#722F37', 'display_order' => 22],
            ['name' => 'Bordô', 'hex_code' => '#800020', 'display_order' => 23],
            ['name' => 'Coral', 'hex_code' => '#FF7F50', 'display_order' => 24],
            ['name' => 'Terracota', 'hex_code' => '#E2725B', 'display_order' => 25],
            
            // === ROSAS ===
            ['name' => 'Rosa', 'hex_code' => '#FFC0CB', 'display_order' => 26],
            ['name' => 'Rosa Claro', 'hex_code' => '#FFB6C1', 'display_order' => 27],
            ['name' => 'Rosa Choque', 'hex_code' => '#FF69B4', 'display_order' => 28],
            ['name' => 'Rosa Escuro', 'hex_code' => '#E75480', 'display_order' => 29],
            ['name' => 'Rosa Salmão', 'hex_code' => '#FF91A4', 'display_order' => 30],
            ['name' => 'Fúcsia', 'hex_code' => '#FF00FF', 'display_order' => 31],
            ['name' => 'Magenta', 'hex_code' => '#FF0090', 'display_order' => 32],
            ['name' => 'Rosa Velho', 'hex_code' => '#C08081', 'display_order' => 33],
            
            // === LARANJAS ===
            ['name' => 'Laranja', 'hex_code' => '#FFA500', 'display_order' => 34],
            ['name' => 'Laranja Claro', 'hex_code' => '#FFD580', 'display_order' => 35],
            ['name' => 'Laranja Escuro', 'hex_code' => '#FF8C00', 'display_order' => 36],
            ['name' => 'Pêssego', 'hex_code' => '#FFCBA4', 'display_order' => 37],
            ['name' => 'Damasco', 'hex_code' => '#FBCEB1', 'display_order' => 38],
            
            // === AMARELOS ===
            ['name' => 'Amarelo', 'hex_code' => '#FFFF00', 'display_order' => 39],
            ['name' => 'Amarelo Claro', 'hex_code' => '#FFFFE0', 'display_order' => 40],
            ['name' => 'Amarelo Escuro', 'hex_code' => '#FFD700', 'display_order' => 41],
            ['name' => 'Amarelo Mostarda', 'hex_code' => '#FFDB58', 'display_order' => 42],
            ['name' => 'Dourado', 'hex_code' => '#FFD700', 'display_order' => 43],
            ['name' => 'Champanhe', 'hex_code' => '#F7E7CE', 'display_order' => 44],
            ['name' => 'Ouro Rosa', 'hex_code' => '#B76E79', 'display_order' => 45],
            
            // === VERDES ===
            ['name' => 'Verde', 'hex_code' => '#008000', 'display_order' => 46],
            ['name' => 'Verde Claro', 'hex_code' => '#90EE90', 'display_order' => 47],
            ['name' => 'Verde Escuro', 'hex_code' => '#006400', 'display_order' => 48],
            ['name' => 'Verde Limão', 'hex_code' => '#32CD32', 'display_order' => 49],
            ['name' => 'Verde Menta', 'hex_code' => '#98FF98', 'display_order' => 50],
            ['name' => 'Verde Esmeralda', 'hex_code' => '#50C878', 'display_order' => 51],
            ['name' => 'Verde Militar', 'hex_code' => '#4B5320', 'display_order' => 52],
            ['name' => 'Verde Oliva', 'hex_code' => '#808000', 'display_order' => 53],
            ['name' => 'Verde Garrafa', 'hex_code' => '#004B49', 'display_order' => 54],
            ['name' => 'Turquesa', 'hex_code' => '#40E0D0', 'display_order' => 55],
            ['name' => 'Água', 'hex_code' => '#00FFFF', 'display_order' => 56],
            
            // === AZUIS ===
            ['name' => 'Azul', 'hex_code' => '#0000FF', 'display_order' => 57],
            ['name' => 'Azul Claro', 'hex_code' => '#ADD8E6', 'display_order' => 58],
            ['name' => 'Azul Escuro', 'hex_code' => '#00008B', 'display_order' => 59],
            ['name' => 'Azul Bebé', 'hex_code' => '#89CFF0', 'display_order' => 60],
            ['name' => 'Azul Celeste', 'hex_code' => '#87CEEB', 'display_order' => 61],
            ['name' => 'Azul Royal', 'hex_code' => '#4169E1', 'display_order' => 62],
            ['name' => 'Azul Marinho', 'hex_code' => '#000080', 'display_order' => 63],
            ['name' => 'Azul Petróleo', 'hex_code' => '#006A6A', 'display_order' => 64],
            ['name' => 'Azul Turquesa', 'hex_code' => '#30D5C8', 'display_order' => 65],
            ['name' => 'Azul Cobalto', 'hex_code' => '#0047AB', 'display_order' => 66],
            ['name' => 'Jeans', 'hex_code' => '#1560BD', 'display_order' => 67],
            
            // === ROXOS E LILÁS ===
            ['name' => 'Roxo', 'hex_code' => '#800080', 'display_order' => 68],
            ['name' => 'Roxo Claro', 'hex_code' => '#DDA0DD', 'display_order' => 69],
            ['name' => 'Roxo Escuro', 'hex_code' => '#4B0082', 'display_order' => 70],
            ['name' => 'Lilás', 'hex_code' => '#C8A2C8', 'display_order' => 71],
            ['name' => 'Lavanda', 'hex_code' => '#E6E6FA', 'display_order' => 72],
            ['name' => 'Violeta', 'hex_code' => '#EE82EE', 'display_order' => 73],
            ['name' => 'Ameixa', 'hex_code' => '#8E4585', 'display_order' => 74],
            ['name' => 'Uva', 'hex_code' => '#6F2DA8', 'display_order' => 75],
            ['name' => 'Berinjela', 'hex_code' => '#614051', 'display_order' => 76],
            
            // === METÁLICOS ===
            ['name' => 'Bronze', 'hex_code' => '#CD7F32', 'display_order' => 77],
            ['name' => 'Cobre', 'hex_code' => '#B87333', 'display_order' => 78],
            ['name' => 'Rose Gold', 'hex_code' => '#B76E79', 'display_order' => 79],
            
            // === ESPECIAIS ===
            ['name' => 'Multicolor', 'hex_code' => null, 'display_order' => 80],
            ['name' => 'Estampado', 'hex_code' => null, 'display_order' => 81],
            ['name' => 'Transparente', 'hex_code' => null, 'display_order' => 82],
            ['name' => 'Neon', 'hex_code' => '#39FF14', 'display_order' => 83],
        ];

        foreach ($colors as $color) {
            DB::table('colors')->insert([
                'name' => $color['name'],
                'slug' => Str::slug($color['name']),
                'hex_code' => $color['hex_code'],
                'is_active' => true,
                'display_order' => $color['display_order'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $this->command->info('✅ Colors seeded: ' . count($colors) . ' colors (organized by color families with variations)');
    }
}
