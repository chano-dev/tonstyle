   {{-- Schema da Loja --}}
    {{-- SCHEMA 1: LOJA (ClothingStore) --}}
    <x-schema-org :data="[
        '@type' => 'OnlineStore',
        'name' => 'Teu Estilo',
        'description' => 'Loja de moda feminina em Angola com roupas, calçados, acessórios e serviços exclusivos',
        'url' => url('/'),
        'logo' => asset('images/logo.png'),
        'image' => asset('images/loja-teu-estilo.jpg'),
        
        // Contato
        'telephone' => '+244923456789',
        'email' => 'contato@teuestilo.ao',
        
        // Endereço
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Rua da Missão, 123',
            'addressLocality' => 'Luanda',
            'addressRegion' => 'Luanda',
            'postalCode' => '00000',
            'addressCountry' => 'AO'
        ],
        
        // Coordenadas GPS (opcional, mas bom para Google Maps)
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => -8.8383,
            'longitude' => 13.2344
        ],
        
        // Horário de Funcionamento
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens' => '09:00',
                'closes' => '18:00'
            ],
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Saturday',
                'opens' => '09:00',
                'closes' => '14:00'
            ]
        ],
        
        // Faixa de Preço
        'priceRange' => '5.000 Kz - 50.000 Kz',
        
        // Moedas Aceitas
        'currenciesAccepted' => 'AOA',
        
        // Formas de Pagamento
        'paymentAccepted' => 'Cash, WhatsApp, Bank Transfer',
        
        // Redes Sociais
        'sameAs' => [
            'https://www.instagram.com/teuestilo',
            'https://www.facebook.com/teuestilo',
            'https://www.tiktok.com/@teuestilo',
            'https://wa.me/244923456789'
        ]
    ]" />

    {{-- SCHEMA 2: WEBSITE (Com Busca) --}}
    <x-schema-org :data="[
        '@type' => 'WebSite',
        'name' => 'Teu Estilo',
        'url' => url('/'),
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => url('/pesquisa?q={search_term_string}')
            ],
            'query-input' => 'required name=search_term_string'
        ]
    ]" />
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
