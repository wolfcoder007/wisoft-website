<?php

use Illuminate\Routing\Router;
/** @var Router $router */

/*$router->group(['prefix' => '/contact'], function (Router $router) {
    $router->get('contactrequests', [
         'as' => 'admin.contact.contactrequest.index',
         'uses' => 'ContactRequestController@index',
     ]);
});*/

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/contact'], function () {
    Route::get('/contact', [ContactController::class, 'index']);
 });

 
$router->group(['prefix' =>'/contact'], function (Router $router) {
    $router->bind('contactRequest', function ($id) {
        return app('Modules\Contact\Repositories\ContactRequestRepository')->find($id);
    });
    $router->get('contacts', [
        'as' => 'admin.contact.contactrequest.index',
        'uses' => 'ContactRequestController@index',
        'middleware' => 'can:contact.contactrequests.index'
    ]);
    $router->get('contact/{contactRequest}/show', [
        'as' => 'admin.contact.contactrequest.show',
        'uses' => 'ContactRequestController@show',
        'middleware' => 'can:contact.contactrequests.show'
    ]);
    $router->delete('contactrequests/{contactRequest}', [
        'as' => 'admin.contact.contactrequest.destroy',
        'uses' => 'ContactRequestController@destroy',
        'middleware' => 'can:contact.contactrequests.destroy'
    ]);

    
    $router->get('contacts/create', [
        'as' => 'admin.contact.contactrequests.create',
        'uses' => 'ContactRequestController@create',
        'middleware' => 'can:contact.contactrequests.create'
    ]);

    $router->post('contact', [
        'as' => 'admin.contact.contactrequest.store',
        'uses' => 'ContactRequestController@store',
        'middleware' => 'can:contact.contactrequests.create'
    ]);
// append

});
