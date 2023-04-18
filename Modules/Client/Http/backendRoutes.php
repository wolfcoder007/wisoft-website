<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/client'], function (Router $router) {
    $router->bind('client', function ($id) {
        return app('Modules\Client\Repositories\ClientRepository')->find($id);
    });
    $router->get('clients', [
        'as' => 'admin.client.client.index',
        'uses' => 'ClientController@index',
        'middleware' => 'can:client.clients.index'
    ]);
    $router->get('clients/create', [
        'as' => 'admin.client.client.create',
        'uses' => 'ClientController@create',
        'middleware' => 'can:client.clients.create'
    ]);
    $router->post('clients', [
        'as' => 'admin.client.client.store',
        'uses' => 'ClientController@store',
        'middleware' => 'can:client.clients.create'
    ]);
    $router->get('clients/{client}/edit', [
        'as' => 'admin.client.client.edit',
        'uses' => 'ClientController@edit',
        'middleware' => 'can:client.clients.edit'
    ]);
    $router->put('clients/{client}', [
        'as' => 'admin.client.client.update',
        'uses' => 'ClientController@update',
        'middleware' => 'can:client.clients.edit'
    ]);
    $router->delete('clients/{client}', [
        'as' => 'admin.client.client.destroy',
        'uses' => 'ClientController@destroy',
        'middleware' => 'can:client.clients.destroy'
    ]);
// append

});
