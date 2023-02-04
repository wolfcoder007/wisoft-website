<?php

return [
    'posts-per-page' => [
        'description'  => 'generalsettings::settings.posts-per-page',
        'view'         => 'text',
        'translatable' => false,
    ],
    
    'post-order' => [
        'description' => 'generalsettings::settings.order-post',
        'view' => 'generalsettings::admin.generalsettings.field.select-order',
    ],
    'order-by' => [
        'description' => 'generalsettings::settings.order-by',
        'view' => 'generalsettings::admin.generalsettings.field.select-order-by',
        'translatable' => false,
    ],
    
];
