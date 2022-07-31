<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 12.05.16
 * Time: 07:24
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Path configuration
    |--------------------------------------------------------------------------
    |
    | Change the paths, so they fit your needs
    |
     */
    'pathToEnv'         =>  base_path() . '/.env',
    'backupPath'        =>  base_path() . '/resources/backups/dotenv-editor/',
    'filePermissions'   =>  0755,

    /*
    |--------------------------------------------------------------------------
    | GUI-Settings
    |--------------------------------------------------------------------------
    |
    | Here you can set the different parameter for the view, where you can edit
    | .env via a graphical interface.
    |
    | Comma-separate your different middlewares.
    |
     */

    // Activate or deactivate the graphical interface
    'activated'       => true,

    /* Default view */
    'template'        => 'dotenv-editor::master',
    'overview'        => 'dotenv-editor::overview',

    // Config route group
    'route'           => [
        'namespace'  => 'Brotzka\DotenvEditor\Http\Controllers',
        'prefix'     => 'settings',
        'as'         => 'admin.env.'
    ],
];
