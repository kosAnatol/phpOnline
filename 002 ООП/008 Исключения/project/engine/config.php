<?php
return [
    'title' => 'Блог',

    'components' => [
        'db' => [
            'class' => \App\services\DB::class,
            'config' => require_once __DIR__ . '/config_db.php'
        ],
        'log' => [
            'class' => \App\services\DB::class,
            'config' => require_once __DIR__ . '/config_db.php'
        ],
        'renderService' => [
            'class' => \App\services\Render\RenderService::class
        ],
        'userRepository' => [
            'class' => \App\repositories\UserRepository::class
        ]
    ]
];