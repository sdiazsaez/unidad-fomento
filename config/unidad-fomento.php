<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 10/21/18
 * Time: 19:28
 */

return [
    'connection' => 'package_test',
    'route_prefix' => 'api/uf',
    'timestamps' => true,
    'on_value_fail' => [
        'get_last' => true,
        'email_to_notify' => env('DEVELOPER_EMAIL', '')
    ],
    'migration_seed_from' => '2019-01-01'
];
