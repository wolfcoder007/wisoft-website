<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/generalsettings'], function (Router $router) {
    $router->bind('generalsetting', function ($id) {
        return app('Modules\GeneralSettings\Repositories\GeneralSettingRepository')->find($id);
    });
    $router->get('generalsettings', [
        'as' => 'admin.generalsettings.generalsetting.index',
        'uses' => 'GeneralSettingController@index',
        'middleware' => 'can:generalsettings.generalsettings.index'
    ]);
    $router->get('generalsettings/create', [
        'as' => 'admin.generalsettings.generalsetting.create',
        'uses' => 'GeneralSettingController@create',
        'middleware' => 'can:generalsettings.generalsettings.create'
    ]);
    $router->post('generalsettings', [
        'as' => 'admin.generalsettings.generalsetting.store',
        'uses' => 'GeneralSettingController@store',
        'middleware' => 'can:generalsettings.generalsettings.create'
    ]);
    $router->get('generalsettings/{generalsetting}/edit', [
        'as' => 'admin.generalsettings.generalsetting.edit',
        'uses' => 'GeneralSettingController@edit',
        'middleware' => 'can:generalsettings.generalsettings.edit'
    ]);
    $router->put('generalsettings/{generalsetting}', [
        'as' => 'admin.generalsettings.generalsetting.update',
        'uses' => 'GeneralSettingController@update',
        'middleware' => 'can:generalsettings.generalsettings.edit'
    ]);
    $router->delete('generalsettings/{generalsetting}', [
        'as' => 'admin.generalsettings.generalsetting.destroy',
        'uses' => 'GeneralSettingController@destroy',
        'middleware' => 'can:generalsettings.generalsettings.destroy'
    ]);
// append

});
