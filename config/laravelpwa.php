<?php

return [
    'name' => 'GrifPoint - Bomberos de Maipu',
    'manifest' => [
        'name' => env('APP_NAME', 'GrifPoint - Bomberos de maipu'),
        'short_name' => 'Bomberos Maipu',
        'start_url' => '/home',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'landscape',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/img/ZonaRiskLogo.png',
                'purpose' => 'any'
            ],
            '96x96' => [
              'path' => '/img/ZonaRiskLogo.png',
                'purpose' => 'any'
            ],
            '128x128' => [
              'path' => '/img/ZonaRiskLogo.png',
                'purpose' => 'any'
            ],
            '144x144' => [
              'path' => '/img/ZonaRiskLogo.png',
                'purpose' => 'any'
            ],
            '152x152' => [
              'path' => '/img/ZonaRiskLogo.png',
                'purpose' => 'any'
            ],
            '192x192' => [
              'path' => '/img/ZonaRiskLogo.png',
                'purpose' => 'any'
            ],
            '384x384' => [
              'path' => '/img/ZonaRiskLogo.png',
                'purpose' => 'any'
            ],
            '512x512' => [
              'path' => '/img/ZonaRiskLogo.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/img/ZonaRiskLogo.png',
            '750x1334' =>  '/img/ZonaRiskLogo.png',
            '828x1792' =>  '/img/ZonaRiskLogo.png',
            '1125x2436' =>  '/img/ZonaRiskLogo.png',
            '1242x2208' => '/img/ZonaRiskLogo.png',
            '1242x2688' =>  '/img/ZonaRiskLogo.png',
            '1536x2048' => '/img/ZonaRiskLogo.png',
            '1668x2224' =>  '/img/ZonaRiskLogo.png',
            '1668x2388' =>  '/img/ZonaRiskLogo.png',
            '2048x2732' =>  '/img/ZonaRiskLogo.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/images/icons/icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
        ],
        'custom' => []
    ]
];
