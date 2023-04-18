<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/** @var Router $router */
//$router->group(['prefix' => '/page', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
$router->group(['prefix' => '/services'], function (Router $router) {
    $router->get('allservices', [
        'as' => 'api.services.service.index',
        'uses' => 'ServiceController@index',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    $router->get('service/{service}', [
        'as' => 'api.services.service.getSingleData',
        'uses' => 'ServiceController@getSingleData',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    
    $router->get('services', [
        'as' => 'api.services.service.servicespagination',
        'uses' => 'ServiceController@servicespagination',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    $router->delete('services/{service}', [
        'as' => 'api.services.service.destroy',
        'uses' => 'ServiceController@destroy',
        //'middleware' => 'token-can:service.services.destroy',
    ]);
    
});
