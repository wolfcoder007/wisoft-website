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

// Route::prefix('v1')->namespace('API')->group(function () {
Route::prefix('v1')->group(function () {

    /**
     * Global
     */
    Route::get('env', 'CustomHTTPController@envSettings');
    // Route::get('intro', 'V2\DefaultController@intro');


    /**
     * Logged In User {Mediator}
     *
     */
    Route::group(['middleware' => 'auth:api'], function () {
       //  Route::post('mediator/auth/update', 'V2\MediatorController@authUpdate');
    });

});
