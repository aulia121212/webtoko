<?php

return [
    'exports' => [
        'chunk_size' => 1000,
        'heading' => 'slugged',
        'csv' => [
            'delimiter' => ',',
            'enclosure' => '"',
            'line_ending' => "\r\n",
            'use_bom' => false,
        ],
    ],

    'imports' => [
        'heading' => 'slugged',
    ],

    'temp' => [
        'directory' => storage_path('framework/cache/laravel-excel'),
    ],

   'transactions' => [
    'handler' => 'db',
],



    'batch' => [
        'enabled' => true,
        'database' => [
            'connection' => null,
            'table' => 'import_batch',
        ],
    ],
];