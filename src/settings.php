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
            'test_mode' => false, // should be false. Only the test classes should change this value
            'host' => 'localhost',
            'name' => 'greenworld-energies',
            'username' => 'root',
            'password' => '',//'1234567',
            'driver' => 'mysql',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'date_format' => 'y-m-d',
            'tables' => [
                'user_table' => 'user',
                'customer_table' => 'customer',
            ],
        ],
        'configuration_mode' => 'development', // or 'production'
    ],
];
