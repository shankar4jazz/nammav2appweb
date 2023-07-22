<?php

return [
    'default_filesystem' => 'r2',

    'filesystems' => [
        'r2' => [
            'driver' => 'r2',
            'account_id' => env('R2_ACCOUNT_ID'),
            'access_key' => env('R2_ACCESS_KEY'),
            'secret_access_key' => env('R2_SECRET_ACCESS_KEY'),
            'bucket' => env('R2_BUCKET_NAME'),
            'endpoint' => 'https://' . env('R2_ACCOUNT_ID') . '.r2.cloudflarestorage.com',
            'region' => 'auto',
            'use_path_style_endpoint' => true,
            'options' => [],
        ],
    ],

    // ...
];
