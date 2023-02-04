y<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::prefix('blug')->group(function() {
//    Route::get('/', 'blugController@index');
//});

/** @var Router $router */
$router->group(['prefix' => 'blug'], function (Router $router) {
    $locale = LaravelLocalization::setLocale() ?: App::getLocale();
    $router->get('posts', [
        'as' => $locale . '.blug',
        'uses' => 'PublicController@index',
        'middleware' => config('asgard.blug.config.middleware'),
    ]);
    $router->get('posts/{slug}', [
        'as' => $locale . '.blug.slug',
        'uses' => 'PublicController@show',
        'middleware' => config('asgard.blug.config.middleware'),
    ]);
});
