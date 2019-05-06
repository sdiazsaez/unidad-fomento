<?php

return [
    'route_prefix' => 'api/uf',
    'on_value_fail' => [
        'get_last' => true,
        'email_to_notify' => env('DEVELOPER_EMAIL', '')
    ],
    'migration_seed_from' => '2019-01-01'
];
