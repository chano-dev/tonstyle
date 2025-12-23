<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $brands = [
            // FAST FASHION
            ['name' => 'Shein', 'slug' => 'shein', 'description' => 'Marca chinesa de fast fashion com peças modernas e acessíveis.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'China', 'is_active' => true, 'is_featured' => true, 'display_order' => 1, 'meta_title' => 'Shein Angola - Moda Fast Fashion | Teu Estilo', 'meta_description' => 'Produtos Shein em Angola: roupas modernas, acessórios e cosméticos a preços acessíveis.'],
            ['name' => 'Zara', 'slug' => 'zara', 'description' => 'Marca espanhola de moda conhecida por designs contemporâneos e qualidade superior.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Espanha', 'is_active' => true, 'is_featured' => true, 'display_order' => 2, 'meta_title' => 'Zara Angola - Moda Europeia Sofisticada | Teu Estilo', 'meta_description' => 'Produtos Zara em Luanda: roupas elegantes, calçados e acessórios com estilo europeu.'],
            ['name' => 'H&M', 'slug' => 'hm', 'description' => 'Marca sueca de moda sustentável e acessível.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Suécia', 'is_active' => true, 'is_featured' => true, 'display_order' => 3, 'meta_title' => 'H&M Angola - Moda Sustentável e Acessível | Teu Estilo', 'meta_description' => 'H&M em Luanda: roupas modernas, acessórios e moda sustentável.'],
            ['name' => 'Mango', 'slug' => 'mango', 'description' => 'Marca espanhola de moda feminina e masculina com estilo mediterrâneo.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Espanha', 'is_active' => true, 'is_featured' => false, 'display_order' => 4, 'meta_title' => 'Mango Angola - Estilo Mediterrâneo | Teu Estilo', 'meta_description' => 'Mango em Luanda: moda feminina e masculina com estilo mediterrâneo.'],
            ['name' => 'Forever 21', 'slug' => 'forever-21', 'description' => 'Marca americana de fast fashion jovem e descontraída.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => false, 'display_order' => 5, 'meta_title' => 'Forever 21 Angola - Moda Jovem | Teu Estilo', 'meta_description' => 'Forever 21 em Luanda: moda jovem e tendências atuais.'],
            ['name' => 'Pull & Bear', 'slug' => 'pull-bear', 'description' => 'Marca espanhola casual urbana do grupo Inditex.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Espanha', 'is_active' => true, 'is_featured' => false, 'display_order' => 6, 'meta_title' => 'Pull & Bear Angola - Streetwear Moderno | Teu Estilo', 'meta_description' => 'Pull & Bear em Luanda: streetwear urbano e moda casual.'],
            
            // LUXO
            ['name' => 'Chanel', 'slug' => 'chanel', 'description' => 'Maison francesa de alta costura fundada por Coco Chanel.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'França', 'is_active' => true, 'is_featured' => true, 'display_order' => 7, 'meta_title' => 'Chanel Angola - Alta Costura e Luxo | Teu Estilo', 'meta_description' => 'Produtos Chanel em Luanda: perfumes icónicos e maquilhagem de luxo.'],
            ['name' => 'Louis Vuitton', 'slug' => 'louis-vuitton', 'description' => 'Marca francesa de luxo especializada em malas e acessórios.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'França', 'is_active' => true, 'is_featured' => true, 'display_order' => 8, 'meta_title' => 'Louis Vuitton Angola - Luxo Francês | Teu Estilo', 'meta_description' => 'Louis Vuitton em Luanda: bolsas de luxo e acessórios em couro.'],
            ['name' => 'Christian Dior', 'slug' => 'christian-dior', 'description' => 'Casa de moda francesa de alta costura.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'França', 'is_active' => true, 'is_featured' => true, 'display_order' => 9, 'meta_title' => 'Christian Dior Angola - Alta Costura Francesa | Teu Estilo', 'meta_description' => 'Dior em Luanda: perfumes exclusivos e maquilhagem de luxo.'],
            ['name' => 'Gucci', 'slug' => 'gucci', 'description' => 'Marca italiana de luxo conhecida por designs ousados.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Itália', 'is_active' => true, 'is_featured' => true, 'display_order' => 10, 'meta_title' => 'Gucci Angola - Luxo Italiano | Teu Estilo', 'meta_description' => 'Gucci em Luanda: bolsas de luxo e acessórios ousados.'],
            ['name' => 'Versace', 'slug' => 'versace', 'description' => 'Casa de moda italiana fundada por Gianni Versace.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Itália', 'is_active' => true, 'is_featured' => false, 'display_order' => 11, 'meta_title' => 'Versace Angola - Glamour Italiano | Teu Estilo', 'meta_description' => 'Versace em Luanda: moda ousada e perfumes exclusivos.'],
            ['name' => 'Yves Saint Laurent', 'slug' => 'ysl', 'description' => 'Maison francesa de luxo fundada por Yves Saint Laurent.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'França', 'is_active' => true, 'is_featured' => true, 'display_order' => 12, 'meta_title' => 'YSL Angola - Elegância Moderna | Teu Estilo', 'meta_description' => 'Yves Saint Laurent em Luanda: maquilhagem de luxo e perfumes icónicos.'],
            ['name' => 'Lacoste', 'slug' => 'lacoste', 'description' => 'Marca francesa de moda desportiva elegante.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'França', 'is_active' => true, 'is_featured' => false, 'display_order' => 13, 'meta_title' => 'Lacoste Angola - Moda Desportiva | Teu Estilo', 'meta_description' => 'Lacoste em Luanda: polo shirts icónicos e moda casual-chic.'],
            ['name' => 'Prada', 'slug' => 'prada', 'description' => 'Casa de moda italiana de luxo fundada em 1913.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Itália', 'is_active' => true, 'is_featured' => false, 'display_order' => 14, 'meta_title' => 'Prada Angola - Minimalismo Luxuoso | Teu Estilo', 'meta_description' => 'Prada em Luanda: bolsas de luxo e acessórios minimalistas.'],
            
            // COSMÉTICOS
            ['name' => 'Sephora', 'slug' => 'sephora', 'description' => 'Retalhista francesa especializada em cosméticos.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'França', 'is_active' => true, 'is_featured' => true, 'display_order' => 15, 'meta_title' => 'Sephora Angola - Cosméticos e Perfumes | Teu Estilo', 'meta_description' => 'Produtos Sephora em Luanda: maquilhagem profissional e skincare.'],
            ['name' => 'MAC Cosmetics', 'slug' => 'mac', 'description' => 'Marca canadiana de maquilhagem profissional.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Canadá', 'is_active' => true, 'is_featured' => true, 'display_order' => 16, 'meta_title' => 'MAC Cosmetics Angola - Maquilhagem Profissional | Teu Estilo', 'meta_description' => 'MAC em Luanda: batons icónicos e maquilhagem profissional.'],
            ['name' => 'Carolina Herrera', 'slug' => 'carolina-herrera', 'description' => 'Marca de moda e perfumes com elegância clássica.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Venezuela', 'is_active' => true, 'is_featured' => false, 'display_order' => 17, 'meta_title' => 'Carolina Herrera Angola - Perfumes | Teu Estilo', 'meta_description' => 'Carolina Herrera em Luanda: perfumes icónicos Good Girl e 212.'],
            ['name' => 'Maybelline', 'slug' => 'maybelline', 'description' => 'Marca americana de cosméticos acessíveis.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => false, 'display_order' => 18, 'meta_title' => 'Maybelline Angola - Maquilhagem Acessível | Teu Estilo', 'meta_description' => 'Maybelline em Luanda: máscaras e batons a preços acessíveis.'],
            ['name' => 'NYX Professional Makeup', 'slug' => 'nyx', 'description' => 'Marca americana de maquilhagem profissional acessível.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => false, 'display_order' => 19, 'meta_title' => 'NYX Angola - Maquilhagem Profissional | Teu Estilo', 'meta_description' => 'NYX em Luanda: paletas de sombras e batons líquidos.'],
            ['name' => 'The Ordinary', 'slug' => 'the-ordinary', 'description' => 'Marca canadiana de skincare científico.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Canadá', 'is_active' => true, 'is_featured' => false, 'display_order' => 20, 'meta_title' => 'The Ordinary Angola - Skincare Científico | Teu Estilo', 'meta_description' => 'The Ordinary em Luanda: séruns e ácidos para skincare.'],
            ['name' => 'CeraVe', 'slug' => 'cerave', 'description' => 'Marca americana de cuidados com a pele recomendada por dermatologistas.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => false, 'display_order' => 21, 'meta_title' => 'CeraVe Angola - Skincare Dermatológico | Teu Estilo', 'meta_description' => 'CeraVe em Luanda: hidratantes e limpadores dermatológicos.'],
            
            // PERUCAS
            ['name' => 'Outre', 'slug' => 'outre', 'description' => 'Marca americana líder em perucas sintéticas e naturais.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => true, 'display_order' => 22, 'meta_title' => 'Outre Angola - Perucas de Qualidade | Teu Estilo', 'meta_description' => 'Perucas Outre em Luanda: lace fronts e full lace de qualidade.'],
            ['name' => 'Sensationnel', 'slug' => 'sensationnel', 'description' => 'Marca americana especializada em perucas premium.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => true, 'display_order' => 23, 'meta_title' => 'Sensationnel Angola - Perucas Premium | Teu Estilo', 'meta_description' => 'Perucas Sensationnel em Luanda: cabelo brasileiro e peruano.'],
            ['name' => 'FreeTress', 'slug' => 'freetress', 'description' => 'Marca de perucas sintéticas acessíveis.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => false, 'display_order' => 24, 'meta_title' => 'FreeTress Angola - Perucas Acessíveis | Teu Estilo', 'meta_description' => 'Perucas FreeTress em Luanda: sintéticos de qualidade.'],
            ['name' => 'Cantu', 'slug' => 'cantu', 'description' => 'Marca americana especializada em produtos para cabelos crespos.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => false, 'display_order' => 25, 'meta_title' => 'Cantu Angola - Produtos Cabelo Crespo | Teu Estilo', 'meta_description' => 'Cantu em Luanda: produtos para cabelo crespo e cacheado.'],
            ['name' => 'Shea Moisture', 'slug' => 'shea-moisture', 'description' => 'Marca americana de cuidados capilares naturais.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => false, 'display_order' => 26, 'meta_title' => 'Shea Moisture Angola - Cuidados Naturais | Teu Estilo', 'meta_description' => 'Shea Moisture em Luanda: champôs e máscaras naturais.'],
            
            // ACESSÓRIOS
            ['name' => 'Pandora', 'slug' => 'pandora', 'description' => 'Marca dinamarquesa de joalheria moderna.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Dinamarca', 'is_active' => true, 'is_featured' => false, 'display_order' => 27, 'meta_title' => 'Pandora Angola - Jóias Personalizáveis | Teu Estilo', 'meta_description' => 'Pandora em Luanda: pulseiras e charms personalizáveis.'],
            ['name' => 'Swarovski', 'slug' => 'swarovski', 'description' => 'Marca austríaca de cristais e joalheria de luxo.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Áustria', 'is_active' => true, 'is_featured' => false, 'display_order' => 28, 'meta_title' => 'Swarovski Angola - Cristais de Luxo | Teu Estilo', 'meta_description' => 'Swarovski em Luanda: colares e brincos com cristais.'],
            ['name' => 'Michael Kors', 'slug' => 'michael-kors', 'description' => 'Marca americana de luxo acessível.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => false, 'display_order' => 29, 'meta_title' => 'Michael Kors Angola - Luxo Acessível | Teu Estilo', 'meta_description' => 'Michael Kors em Luanda: bolsas e relógios elegantes.'],
            
            // OUTROS
            ['name' => 'AliExpress', 'slug' => 'aliexpress', 'description' => 'Plataforma chinesa de comércio eletrónico.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'China', 'is_active' => true, 'is_featured' => false, 'display_order' => 30, 'meta_title' => 'AliExpress Angola - Variedade Online | Teu Estilo', 'meta_description' => 'Produtos AliExpress em Luanda: roupas e acessórios.'],
            ['name' => 'Lilás', 'slug' => 'lilas', 'description' => 'Marca angolana local de moda feminina.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Angola', 'is_active' => true, 'is_featured' => true, 'display_order' => 31, 'meta_title' => 'Lilás Angola - Moda Angolana Local | Teu Estilo', 'meta_description' => 'Lilás: marca angolana de moda feminina em Luanda.'],
            ['name' => 'Tiffany & Co.', 'slug' => 'tiffany', 'description' => 'Casa joalheira americana icónica fundada em 1837.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => false, 'display_order' => 32, 'meta_title' => 'Tiffany & Co. Angola - Joalheria de Luxo | Teu Estilo', 'meta_description' => 'Tiffany em Luanda: anéis e colares em ouro e diamantes.'],
            ['name' => 'Nike', 'slug' => 'nike', 'description' => 'Marca americana líder em moda desportiva.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Estados Unidos', 'is_active' => true, 'is_featured' => false, 'display_order' => 33, 'meta_title' => 'Nike Angola - Moda Desportiva | Teu Estilo', 'meta_description' => 'Nike em Luanda: ténis icónicos e roupa desportiva.'],
            ['name' => 'Adidas', 'slug' => 'adidas', 'description' => 'Marca alemã de moda desportiva e lifestyle.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => 'Alemanha', 'is_active' => true, 'is_featured' => false, 'display_order' => 34, 'meta_title' => 'Adidas Angola - Performance e Estilo | Teu Estilo', 'meta_description' => 'Adidas em Luanda: ténis e fatos de treino.'],
            ['name' => 'Genérico', 'slug' => 'generico', 'description' => 'Produtos sem marca específica.', 'logo_path' => null, 'banner_path' => null, 'country_origin' => null, 'is_active' => true, 'is_featured' => false, 'display_order' => 35, 'meta_title' => 'Produtos Genéricos Angola | Teu Estilo', 'meta_description' => 'Produtos genéricos em Luanda a preços acessíveis.'],
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->updateOrInsert(
                ['slug' => $brand['slug']], // Chave única
                [
                    'name' => $brand['name'],
                    'description' => $brand['description'],
                    'logo_path' => $brand['logo_path'],
                    'banner_path' => $brand['banner_path'],
                    'country_origin' => $brand['country_origin'],
                    'is_active' => $brand['is_active'],
                    'is_featured' => $brand['is_featured'],
                    'display_order' => $brand['display_order'],
                    'meta_title' => $brand['meta_title'],
                    'meta_description' => $brand['meta_description'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $this->command->info('✅ Brands seeded: 35 brands (10 featured)');
    }
}