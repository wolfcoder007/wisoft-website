<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/blug', function (Request $request) {
//    return $request->user();
//});

/** @var Router $router */
$router->group(['prefix' => 'v1', 'middleware' => 'api.token'], function (Router $router) {
    $router->post('tag', [
        'as' => 'api.tag.store',
        'uses' => 'TagController@store',
    ]);
    $router->get('tag/findByName/{name?}', [
        'as' => 'api.tag.findByName',
        'uses' => 'TagController@findByName',
    ]);
});

$router->group(['prefix' => 'v1/blug', 'middleware' => 'api.token'], function (Router $router) {
    $router->get('categories', [
        'as' => 'api.blug.category.index',
        'uses' => 'V1\CategoryController@index',
        'middleware' => 'token-can:blug.categories.index',
    ]);

    $router->post('categories', [
        'as' => 'api.blug.category.store',
        'uses' => 'V1\CategoryController@store',
        'middleware' => 'token-can:blug.categories.create',
    ]);

    $router->post('categories/{category}', [
        'as' => 'api.blug.category.update',
        'uses' => 'V1\CategoryController@update',
        'middleware' => 'token-can:blug.categories.edit',
    ]);

    $router->delete('categories/{category}', [
        'as' => 'api.blug.category.destroy',
        'uses' => 'V1\CategoryController@destroy',
        'middleware' => 'token-can:blug.categories.destroy',
    ]);
});
