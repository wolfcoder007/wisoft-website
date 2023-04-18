<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/** @var Router $router */
//$router->group(['prefix' => '/page', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
$router->group(['prefix' => '/clients'], function (Router $router) {
    $router->get('allclients', [
        'as' => 'api.clients.client.index',
        'uses' => 'ClientController@index',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    $router->get('client/{client}', [
        'as' => 'api.clients.client.getSingleData',
        'uses' => 'ClientController@getSingleData',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    
    $router->get('clients', [
        'as' => 'api.clients.client.clientspagination',
        'uses' => 'ClientController@clientspagination',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    $router->delete('client/{client}', [
        'as' => 'api.clients.client.destroy',
        'uses' => 'ClientController@destroy',
        //'middleware' => 'token-can:service.services.destroy',
    ]);
    
});
