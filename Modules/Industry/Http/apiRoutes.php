<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/** @var Router $router */
//$router->group(['prefix' => '/page', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
$router->group(['prefix' => '/industry'], function (Router $router) {
    $router->get('allindustries', [
        'as' => 'api.industry.industry.index',
        'uses' => 'IndustryController@index',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    $router->get('industry/{industry}', [
        'as' => 'api.industry.industry.getSingleData',
        'uses' => 'IndustryController@getSingleData',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    
    $router->get('industries', [
        'as' => 'api.industry.industry.industriespagination',
        'uses' => 'IndustryController@industriespagination',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    $router->delete('industry/{industry}', [
        'as' => 'api.industry.industry.destroy',
        'uses' => 'IndustryController@destroy',
        //'middleware' => 'token-can:service.services.destroy',
    ]);
    
});
