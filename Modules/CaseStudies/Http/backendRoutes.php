<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/casestudies'], function (Router $router) {
    $router->bind('casestudies', function ($id) {
        return app('Modules\CaseStudies\Repositories\CaseStudiesRepository')->find($id);
    });
    $router->get('casestudies', [
        'as' => 'admin.casestudies.casestudies.index',
        'uses' => 'CaseStudiesController@index',
        'middleware' => 'can:casestudies.casestudies.index'
    ]);
    $router->get('casestudies/create', [
        'as' => 'admin.casestudies.casestudies.create',
        'uses' => 'CaseStudiesController@create',
        'middleware' => 'can:casestudies.casestudies.create'
    ]);
    $router->post('casestudies', [
        'as' => 'admin.casestudies.casestudies.store',
        'uses' => 'CaseStudiesController@store',
        'middleware' => 'can:casestudies.casestudies.create'
    ]);
    $router->get('casestudies/{casestudies}/edit', [
        'as' => 'admin.casestudies.casestudies.edit',
        'uses' => 'CaseStudiesController@edit',
        'middleware' => 'can:casestudies.casestudies.edit'
    ]);
    $router->put('casestudies/{casestudies}', [
        'as' => 'admin.casestudies.casestudies.update',
        'uses' => 'CaseStudiesController@update',
        'middleware' => 'can:casestudies.casestudies.edit'
    ]);
    $router->delete('casestudies/{casestudies}', [
        'as' => 'admin.casestudies.casestudies.destroy',
        'uses' => 'CaseStudiesController@destroy',
        'middleware' => 'can:casestudies.casestudies.destroy'
    ]);
// append

});
