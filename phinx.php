<?php

require_once __DIR__ . '/app/config/config.php';

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => DB_HOST,
            'name' => DB_DATABASE,
            'user' => DB_USER,
            'pass' => DB_PASSWORD,
            'port' => DB_PORT,
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => DB_HOST,
            'name' => DB_DATABASE,
            'user' => DB_USER,
            'pass' => DB_PASSWORD,
            'port' => DB_PORT,
            'charset' => 'utf8',
        ],
//        'testing' => [
//            'adapter' => 'mysql',
//            'host' => 'localhost',
//            'name' => 'testing_db',
//            'user' => 'root',
//            'pass' => '',
//            'port' => '3306',
//            'charset' => 'utf8',
//        ]
    ],
    'version_order' => 'creation'
];
