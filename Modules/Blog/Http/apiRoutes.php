<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/** @var Router $router */
//$router->group(['prefix' => '/page', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
$router->group(['prefix' => '/blog'], function (Router $router) {
    $router->get('allposts', [
        'as' => 'api.blogs.post.index',
        'uses' => 'PostController@index',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    $router->get('post/{blog}', [
        'as' => 'api.blogs.post.getSingleData',
        'uses' => 'PostController@getSingleData',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    
    $router->get('posts', [
        'as' => 'api.blogs.post.blogspagination',
        'uses' => 'PostController@blogspagination',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    $router->delete('post/{post}', [
        'as' => 'api.blogs.post.destroy',
        'uses' => 'PostController@destroy',
        //'middleware' => 'token-can:service.services.destroy',
    ]);
    
});
