<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/** @var Router $router */
//$router->group(['prefix' => '/page', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
$router->group(['prefix' => '/casestudies'], function (Router $router) {
    $router->get('allcasestudies', [
        'as' => 'api.casestudies.casestudies.index',
        'uses' => 'CaseStudiesController@index',
        //'middleware' => 'token-can:casestudies.casestudies.index',
    ]);
    
    $router->get('casestudy/{casestudies}', [
        'as' => 'api.casestudies.casestudies.getSingleData',
        'uses' => 'CaseStudiesController@getSingleData',
        //'middleware' => 'token-can:casestudies.casestudies.index',
    ]);
    
    
    $router->get('casestudies', [
        'as' => 'api.casestudies.casestudies.casestudiespagination',
        'uses' => 'CaseStudiesController@casestudiespagination',
        //'middleware' => 'token-can:casestudies.casestudies.index',
    ]);
    $router->delete('casestudies/{casestudies}', [
        'as' => 'api.casestudies.casestudies.destroy',
        'uses' => 'CaseStudiesController@destroy',
        //'middleware' => 'token-can:casestudies.casestudies.destroy',
    ]);});
