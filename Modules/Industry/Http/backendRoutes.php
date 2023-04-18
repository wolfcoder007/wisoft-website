<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/industry'], function (Router $router) {
    $router->bind('industry', function ($id) {
        return app('Modules\Industry\Repositories\IndustryRepository')->find($id);
    });
    $router->get('industries', [
        'as' => 'admin.industry.industry.index',
        'uses' => 'IndustryController@index',
        'middleware' => 'can:industry.industries.index'
    ]);
    $router->get('industries/create', [
        'as' => 'admin.industry.industry.create',
        'uses' => 'IndustryController@create',
        'middleware' => 'can:industry.industries.create'
    ]);
    $router->post('industries', [
        'as' => 'admin.industry.industry.store',
        'uses' => 'IndustryController@store',
        'middleware' => 'can:industry.industries.create'
    ]);
    $router->get('industries/{industry}/edit', [
        'as' => 'admin.industry.industry.edit',
        'uses' => 'IndustryController@edit',
        'middleware' => 'can:industry.industries.edit'
    ]);
    $router->put('industries/{industry}', [
        'as' => 'admin.industry.industry.update',
        'uses' => 'IndustryController@update',
        'middleware' => 'can:industry.industries.edit'
    ]);
    $router->delete('industries/{industry}', [
        'as' => 'admin.industry.industry.destroy',
        'uses' => 'IndustryController@destroy',
        'middleware' => 'can:industry.industries.destroy'
    ]);
// append

});
