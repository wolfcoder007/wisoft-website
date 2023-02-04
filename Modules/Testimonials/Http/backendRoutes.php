<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/testimonials'], function (Router $router) {
    $router->bind('testimonial', function ($id) {
        return app('Modules\Testimonials\Repositories\TestimonialRepository')->find($id);
    });
    $router->get('testimonials', [
        'as' => 'admin.testimonials.testimonial.index',
        'uses' => 'TestimonialController@index',
        'middleware' => 'can:testimonials.testimonials.index'
    ]);
    $router->get('testimonials/create', [
        'as' => 'admin.testimonials.testimonial.create',
        'uses' => 'TestimonialController@create',
        'middleware' => 'can:testimonials.testimonials.create'
    ]);
    $router->post('testimonials', [
        'as' => 'admin.testimonials.testimonial.store',
        'uses' => 'TestimonialController@store',
        'middleware' => 'can:testimonials.testimonials.create'
    ]);
    $router->get('testimonials/{testimonial}/edit', [
        'as' => 'admin.testimonials.testimonial.edit',
        'uses' => 'TestimonialController@edit',
        'middleware' => 'can:testimonials.testimonials.edit'
    ]);
    $router->put('testimonials/{testimonial}', [
        'as' => 'admin.testimonials.testimonial.update',
        'uses' => 'TestimonialController@update',
        'middleware' => 'can:testimonials.testimonials.edit'
    ]);
    $router->delete('testimonials/{testimonial}', [
        'as' => 'admin.testimonials.testimonial.destroy',
        'uses' => 'TestimonialController@destroy',
        'middleware' => 'can:testimonials.testimonials.destroy'
    ]);
// append

});
