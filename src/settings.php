<?php

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Renderer settings
        'renderer' => [
            'template_paths' => [
                '__main__' => __DIR__ . '/../src/views',
                'views' => __DIR__ . '/../src/views',
                'forms' => __DIR__ . '/../src/views/forms',
                'partials' => __DIR__ . '/../src/views/partials',
            ],
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' =>__DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'db' => [
            'host' => 'localhost:3306',
            'name' => 'greenworld-energys',
            'username' => 'root',
            'password' => '1234567',
            'driver' => 'mysql',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'dateformat' => 'y-m-d',
            'tablenames' => [
                'user-table' => 'user',
                'customer-table' => 'customer',
            ],
        ],
    ],
];
