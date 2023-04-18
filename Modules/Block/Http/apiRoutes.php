<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/** @var Router $router */
//$router->group(['prefix' => '/page', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
$router->group(['prefix' => '/blocks'], function (Router $router) {
    $router->get('allblocks', [
        'as' => 'api.blocks.block.index',
        'uses' => 'BlockController@index',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    $router->get('block/{block}', [
        'as' => 'api.blocks.block.getSingleData',
        'uses' => 'BlockController@getSingleData',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    
    $router->get('blocks', [
        'as' => 'api.blocks.block.blockspagination',
        'uses' => 'BlockController@blockspagination',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    $router->delete('block/{block}', [
        'as' => 'api.blocks.block.destroy',
        'uses' => 'BlockController@destroy',
        //'middleware' => 'token-can:service.services.destroy',
    ]);
    
});
