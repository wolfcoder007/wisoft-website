<?php

return [
    'smtp.providers' => [
        'index' => 'smtp::providers.list resource',
        'create' => 'smtp::providers.create resource',
        'edit' => 'smtp::providers.edit resource',
        'destroy' => 'smtp::providers.destroy resource',
    ],
    'smtp.templates' => [
        'index' => 'smtp::templates.list resource',
        'create' => 'smtp::templates.create resource',
        'edit' => 'smtp::templates.edit resource',
        'destroy' => 'smtp::templates.destroy resource',
    ],
// append


];
