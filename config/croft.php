<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Hosts
    |--------------------------------------------------------------------------
    |
    */

    'hosts' => [
        'api' => env('APP_HOST_API')
    ],

    /*
    |--------------------------------------------------------------------------
    | Security
    |--------------------------------------------------------------------------
    |
    */

    'permissions' => [
        'disabled' => (bool) env('APP_PERMISSIONS_DISABLED', true),
    ],

    'token' => [
        'name' => env('APP_TOKEN_NAME', env('APP_NAME', 'Laravel')),
        'refresh_threshold' => 60 * 24 * 3 // minutes
    ],

    'recovery' => [
        'ttl' => 60, // minutes
        'length' => 12
    ],

    'verification' => [
        'ttl' => 60, // minutes
        'length' => 12
    ],

    /*
    |--------------------------------------------------------------------------
    | Uploads
    |--------------------------------------------------------------------------
    |
    */

    'uploads' => [
        'files' => [
            'disk' => 'public',
            'dir' => 'files'
        ],

        'images' => [
            'disk' => 'public',
            'dir' => 'images'
        ],

        'videos' => [
            'disk' => 'public',
            'dir' => 'videos'
        ],

        'default' => [
            'disk' => 'public',
            'dir' => 'upload'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Queries
    |--------------------------------------------------------------------------
    |
    */

    'queries' => [
        'maxLimit' => 100,
    ],

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    */

    'models' => [
        'namespace' => 'App\Models\\'
    ],

    /*
    |--------------------------------------------------------------------------
    | Enums
    |--------------------------------------------------------------------------
    |
    */

    'enum' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Responses
    |--------------------------------------------------------------------------
    |
    */

    'responses' => [
        'key' => [
            'message' => 'message'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Response Relationships
    |--------------------------------------------------------------------------
    | These values are passed to Laravel's ->load() or ->with() functions. They are defined
    | here as a convenience and to minimize repeating code.
    */

    'relationships' => [
        'address' => [
            'index' => [],
            'show' => [],
            'store' => []
        ],

        'equipment_asset' => [
            'show' => [ 'classification', 'circuits', 'logs', 'videos', 'images' ],
        ],

        'file' => [
            'index' => [],
            'show' => [],
            'store' => []
        ],

        'goal' => [
            'index' => [ 'category' ],
            'show' => [ 'category' ],
            'store' => [ 'category' ]
        ],

        'image' => [
            'index' => [],
            'show' => [],
            'store' => []
        ],

        'meta' => [
            'index' => [],
            'show' => [],
            'store' => []
        ],

        'user' => [
            'index' => [],
            'show' => [],
            'store' => []
        ],

        'site' => [
            'index' => [],
            'show' => [],
            'update' => [],
            'store' => []
        ],

        'service_event' => [
            'index' => [ 'site' ],
            'show' => [
                'cylinder_assets',
                'equipment_assets',
                'site',
                'installs',
                'repairs',
                'leak_inspections',
                'scraps',
                'shutdown_mothballs',
                'shutdown_mothballs',
                'gas_charges',
                'gas_recoveries',
                'images',
                'videos',
                'user'
            ],
            'update' =>[
                'cylinder_assets',
                'equipment_assets',
                'site',
                'installs',
                'repairs',
                'leak_inspections',
                'scraps',
                'shutdown_mothballs',
                'shutdown_mothballs',
                'gas_charges',
                'gas_recoveries',
                'images',
                'videos',
                'user'
            ],
            'store' => [
                'cylinder_assets',
                'equipment_assets',
                'site',
                'installs',
                'repairs',
                'leak_inspections',
                'scraps',
                'shutdown_mothballs',
                'shutdown_mothballs',
                'gas_charges',
                'gas_recoveries',
                'images',
                'videos',
                'user'
            ],
        ],

        'service_event_gas_recovery' => [
            'index' => [ ],
            'show' =>  [
                'gas_transfer',
                'gas_transfer.gas_recoveries_from',
                'gas_transfer.gas_recoveries_to',
            ],
            'update' =>  [
                'gas_transfer',
                'gas_transfer.gas_recoveries_from',
                'gas_transfer.gas_recoveries_to',
            ],
            'store' => [
                'gas_transfer',
                'gas_transfer.gas_recoveries_from',
                'gas_transfer.gas_recoveries_to',
            ]
        ],

        'user' => [
            'index' => [ 'avatar' ],
            'show' =>  ['address', 'profile', 'avatar', 'company'],
            'update' =>  [],
            'store' => []
        ],


        'user_service_event' => [
            'index' => [ 'cylinder_assets', 'equipment_assets', 'site' ],
            'show' => [ 'cylinder_assets', 'equipment_assets', 'site' ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Response Attributes
    |--------------------------------------------------------------------------
    | These values are passed to Laravel's ->append() function. They are defined
    | here as a convenience and to minimize repeating code.
    */

    'attributes' => [
        'address' => [
            'index' => [],
            'show'  => [],
            'store' => []
        ],

        'file' => [
            'index' => [ 'uri', 'url' ],
            'show' => [ 'uri', 'url' ],
            'store' => [ 'uri', 'url' ]
        ],

        'equipment_asset' => [
            'index' => [ ],
            'show' => [ ],
            'store' => [ ]
        ],

        'goal' => [
            'index' => [],
            'show' => [],
            'store' => []
        ],

        'image' => [
            'index' => [ 'uri', 'url' ],
            'show' => [ 'uri', 'url' ],
            'store' => [ 'uri', 'url' ]
        ],

        'meta' => [
            'index' => [],
            'show'  => [],
            'store' => []
        ],

        'user' => [
            'index' => [],
            'show' => [],
            'store' => []
        ],

        'site' => [
            'index' => [],
            'show' =>  [],
            'store' => [],
            'update' => [],
        ],

        'service_event' => [
            'index' => [],
            'show' =>  ['serviced_equipment_assets'],
            'update' =>  [],
            'store' => []
        ],


        'service_event_gas_recovery' => [
            'index' => [],
            'show' =>  [],
            'update' =>  [],
            'store' => []
        ],

        'user' => [
            'index' => [ 'email', 'full_name' ],
            'show' =>  [ 'email', 'full_name', 'total_points', 'is_identified', 'is_badges_public', 'is_certifications_public', 'is_points_public', 'is_dark_mode_enabled' ],
            'update' =>  [ 'email', 'full_name', 'total_points', 'is_identified', 'is_badges_public', 'is_certifications_public', 'is_points_public', 'is_dark_mode_enabled' ],
            'store' => []
        ],

        'user_service_event' => [
            'index' => [],
            'show' =>  [],
        ]
    ]

];
