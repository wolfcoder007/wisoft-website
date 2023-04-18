<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


$router->group(['prefix' => '/slider'], function (Router $router) {
    $router->get('slider/{slider}', [
        'as' => 'api.blogs.post.getSliderData',
        'uses' => 'SliderController@getSliderData',
        //'middleware' => 'token-can:service.services.index',
    ]);
    
    
    $router->get('allslider', [
        'as' => 'api.slider.slider.index',
        'uses' => 'SliderController@index',
        //'middleware' => 'token-can:testimonial.testimonials.index',
    ]);
});




/** @var Router $router */
$router->group(['prefix' => '/slider'], function (Router $router) {
    $router->post('/update', 'SliderController@update')
        ->name('api.slider.slide.update');
      //  ->middleware('token-can:slider.slides.edit');

    $router->post('/delete', 'SliderController@delete')
        ->name('api.slider.slide.delete');
       // ->middleware('token-can:slider.slides.destroy');
});