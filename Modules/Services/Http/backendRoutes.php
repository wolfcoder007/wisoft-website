<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/services'], function (Router $router) {
    $router->bind('service', function ($id) {
        return app('Modules\Services\Repositories\ServiceRepository')->find($id);
    });
    $router->get('services', [
        'as' => 'admin.services.service.index',
        'uses' => 'ServiceController@index',
        'middleware' => 'can:services.services.index'
    ]);
    $router->get('services/create', [
        'as' => 'admin.services.service.create',
        'uses' => 'ServiceController@create',
        'middleware' => 'can:services.services.create'
    ]);
    $router->post('services', [
        'as' => 'admin.services.service.store',
        'uses' => 'ServiceController@store',
        'middleware' => 'can:services.services.create'
    ]);
    $router->get('services/{service}/edit', [
        'as' => 'admin.services.service.edit',
        'uses' => 'ServiceController@edit',
        'middleware' => 'can:services.services.edit'
    ]);
    $router->put('services/{service}', [
        'as' => 'admin.services.service.update',
        'uses' => 'ServiceController@update',
        'middleware' => 'can:services.services.edit'
    ]);
    $router->delete('services/{service}', [
        'as' => 'admin.services.service.destroy',
        'uses' => 'ServiceController@destroy',
        'middleware' => 'can:services.services.destroy'
    ]);
// append

});
