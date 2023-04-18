<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/seo'], function (Router $router) {
    $router->bind('seo', function ($id) {
        return app('Modules\Seo\Repositories\SeoRepository')->find($id);
    });
    $router->get('seos', [
        'as' => 'admin.seo.seo.index',
        'uses' => 'SeoController@index',
        'middleware' => 'can:seo.seos.index'
    ]);
    $router->get('seos/create', [
        'as' => 'admin.seo.seo.create',
        'uses' => 'SeoController@create',
        'middleware' => 'can:seo.seos.create'
    ]);
    $router->post('seos', [
        'as' => 'admin.seo.seo.store',
        'uses' => 'SeoController@store',
        'middleware' => 'can:seo.seos.create'
    ]);
    $router->get('seos/{seo}/edit', [
        'as' => 'admin.seo.seo.edit',
        'uses' => 'SeoController@edit',
        //'middleware' => 'can:seo.seos.edit'
    ]);
    $router->put('seos/{seo}', [
        'as' => 'admin.seo.seo.update',
        'uses' => 'SeoController@update',
        'middleware' => 'can:seo.seos.edit'
    ]);
    $router->delete('seos/{seo}', [
        'as' => 'admin.seo.seo.destroy',
        'uses' => 'SeoController@destroy',
        'middleware' => 'can:seo.seos.destroy'
    ]);
// append

});
