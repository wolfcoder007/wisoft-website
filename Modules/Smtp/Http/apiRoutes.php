<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/** @var Router $router */
//$router->group(['prefix' => '/page', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
$router->group(['prefix' => '/sendmail'], function (Router $router) {
    $router->post('test', [
        'as' => 'api.smtp.sendmail.index',
        'uses' => 'SendMailController@index',
        //'middleware' => 'token-can:service.services.index',
    ]);

    $router->post('subscribe', [
        'as' => 'api.smtp.sendmail.subscribe',
        'uses' => 'SendMailController@subscribe',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    
});

//Route::post('/subscribe', [SendMailController::class, 'subscribe']);

