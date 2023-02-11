<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Navigation Title
    |--------------------------------------------------------------------------
    |
    | This is the text Nova's navigation sidebar will display for this tool.
    |
    | Defaults to 'Settings' if not specified here.
    |
    */
    'sidebar-title' => 'Settings',

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | This is the good stuff :). Each 'panel' will be shown grouped together
    | under its 'title'. Each 'setting' in a panel will display a row in Nova,
    | and you can specify the key used to store its value on disk, its display
    | title in Nova, a description, its type (only boolean or text for now),
    | and a link for more information.
    |
    | Each setting must include at least a key, title, and type.
    |
    */
    'settings' => [
        [
            'key' => 'toggle_setting',
            'title' => 'Example toggle setting',
            'type' => 'toggle',
            'description' => 'Description for toggle setting',
            'panel' => 'Panel 1',
        ],
        [
            'key' => 'text_setting',
            'title' => 'Example text setting',
            'type' => 'text',
            'description' => 'Description for text setting',
            'panel' => 'Panel 2',
        ],
    ],
];
