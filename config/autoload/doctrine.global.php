<?php

return [
    'doctrine' => [
        'connection' => [
            'orm' => [
                'auto_generate_proxy_classes' => true,
                'proxy_dir' => 'data/cache/Proxy',
                'proxy_namespace' => 'Proxy',
                'underscore_naming_strategy' => true,
            ],
            'orm_default' => [
                'driverClass' => Doctrine\DBAL\Driver\PDO\PgSQL\Driver::class,
                'host' => $_ENV['DB_HOSTNAME'],
                'port' => $_ENV['DB_PORT'],
                'user' => $_ENV['DB_USERNAME'],
                'password' => $_ENV['DB_PASSWORD'],
                'dbname' => $_ENV['DB_DATABASE'],
                'charset' => 'utf8',
                'driverOptions' => [
                    \PDO::ATTR_EMULATE_PREPARES => 1,
                    \PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ],
            ],
        ],
    ]
];