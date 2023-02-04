<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

use Modules\Testimonials\Http\Controllers\Admin\TestimonialApiController;

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

/*Route::middleware('auth:api')->get('/testimonials', function (Request $request) {
    return $request->user();
});*/

$router->get('test-g', function (Request $request) {
    return "testimonial";
});

Route::get("tesmonialList/{pegination?}", [TestimonialApiController::class, 'getTesmonialList']);

Route::get("tesmonial/{testimonial}", [TestimonialApiController::class, 'getTesmonial']);

/** @var Router $router */
/*Route::group(['prefix' => 'v1'], function (Router $router) {
    Route::get('testimonial', [
       'as' => 'api.testimonial.get',
        'uses' => 'TestimonialController@getTesmonialList',
    ]);
    /*$router->get('tag/findByName/{name?}', [
        'as' => 'api.tag.findByName',
        'uses' => 'TagController@findByName',
    ]);*/
//});