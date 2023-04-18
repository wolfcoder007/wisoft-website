<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/smtp'], function (Router $router) {
    $router->bind('provider', function ($id) {
        return app('Modules\Smtp\Repositories\ProviderRepository')->find($id);
    });
    $router->get('providers', [
        'as' => 'admin.smtp.provider.index',
        'uses' => 'ProviderController@index',
        'middleware' => 'can:smtp.providers.index'
    ]);
    $router->get('providers/create', [
        'as' => 'admin.smtp.provider.create',
        'uses' => 'ProviderController@create',
        'middleware' => 'can:smtp.providers.create'
    ]);
    $router->post('providers', [
        'as' => 'admin.smtp.provider.store',
        'uses' => 'ProviderController@store',
        'middleware' => 'can:smtp.providers.create'
    ]);
    $router->get('providers/{provider}/edit', [
        'as' => 'admin.smtp.provider.edit',
        'uses' => 'ProviderController@edit',
        'middleware' => 'can:smtp.providers.edit'
    ]);
    $router->put('providers/{provider}', [
        'as' => 'admin.smtp.provider.update',
        'uses' => 'ProviderController@update',
        'middleware' => 'can:smtp.providers.edit'
    ]);
    $router->delete('providers/{provider}', [
        'as' => 'admin.smtp.provider.destroy',
        'uses' => 'ProviderController@destroy',
        'middleware' => 'can:smtp.providers.destroy'
    ]);
    $router->bind('template', function ($id) {
        return app('Modules\Smtp\Repositories\TemplateRepository')->find($id);
    });
    $router->get('templates', [
        'as' => 'admin.smtp.template.index',
        'uses' => 'TemplateController@index',
        'middleware' => 'can:smtp.templates.index'
    ]);
    $router->get('templates/create', [
        'as' => 'admin.smtp.template.create',
        'uses' => 'TemplateController@create',
        'middleware' => 'can:smtp.templates.create'
    ]);
    $router->post('templates', [
        'as' => 'admin.smtp.template.store',
        'uses' => 'TemplateController@store',
        'middleware' => 'can:smtp.templates.create'
    ]);
    $router->get('templates/{template}/edit', [
        'as' => 'admin.smtp.template.edit',
        'uses' => 'TemplateController@edit',
        'middleware' => 'can:smtp.templates.edit'
    ]);
    $router->put('templates/{template}', [
        'as' => 'admin.smtp.template.update',
        'uses' => 'TemplateController@update',
        'middleware' => 'can:smtp.templates.edit'
    ]);
    $router->delete('templates/{template}', [
        'as' => 'admin.smtp.template.destroy',
        'uses' => 'TemplateController@destroy',
        'middleware' => 'can:smtp.templates.destroy'
    ]);
// append


});
