<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Modules\Blog\Http\Controllers\Admin\CategoryController;


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

//Route::middleware('auth:api')->get('/blog', function (Request $request) {
//    return $request->user();
//});

    $router->get('category', function (Request $request) {
    return "hello";
    
});

Route::get("hello", [CategoryController::class, 'index']);

/** @var Router $router */
//$router->group(['prefix' => 'v1', 'middleware' => 'api.token'], function (Router $router) {
//    $router->post('tag', [
//        'as' => 'api.tag.store',
//        'uses' => 'TagController@store',
//    ]);
//    $router->get('tag/findByName/{name?}', [
//        'as' => 'api.tag.findByName',
//        'uses' => 'TagController@findByName',
//    ]);
//});

//$router->group(['prefix' => 'v1/blog', 'middleware' => 'api.token'], function (Router $router) {
//$router->group(['prefix' => 'v1/blog'], function (Router $router) {
//    $router->get('categories', [
//        'as' => 'api.blog.category.index',
//        'uses' => 'V1\CategoryController@index',
//      //  'middleware' => 'token-can:blog.categories.index',
//    ]);
//
//    $router->post('categories', [
//        'as' => 'api.blog.category.store',
//        'uses' => 'V1\CategoryController@store',
//        'middleware' => 'token-can:blog.categories.create',
//    ]);
//
//    $router->post('categories/{category}', [
//        'as' => 'api.blog.category.update',
//        'uses' => 'V1\CategoryController@update',
//        'middleware' => 'token-can:blog.categories.edit',
//    ]);
//
//    $router->delete('categories/{category}', [
//        'as' => 'api.blog.category.destroy',
//        'uses' => 'V1\CategoryController@destroy',
//        'middleware' => 'token-can:blog.categories.destroy',
//    ]);
//});
