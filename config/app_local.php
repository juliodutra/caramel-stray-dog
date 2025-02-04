return [
    'debug' => true,
    'Security' => [
        'salt' => env('SECURITY_SALT', ''),
    ],
    'Datasources' => [
        'default' => [
            'host' => env('DB_HOST', 'localhost'),
            'username' => env('DB_USERNAME', 'sidewalk_user'),
            'password' => env('DB_PASSWORD', ''),
            'database' => env('DB_NAME', 'sidewalk_donations'),
        ],
    ],
    'Authentication' => [
        'OAuth' => [
            'Google' => [
                'clientId' => env('GOOGLE_CLIENT_ID', ''),
                'clientSecret' => env('GOOGLE_CLIENT_SECRET', ''),
            ],
            'Facebook' => [
                'clientId' => env('FACEBOOK_CLIENT_ID', ''),
                'clientSecret' => env('FACEBOOK_CLIENT_SECRET', ''),
            ],
        ],
    ],
];