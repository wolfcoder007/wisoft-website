<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/** @var Router $router */
$router->group(['prefix' => '/slide'], function (Router $router) {
    $router->post('/update', 'SlideController@update')
        ->name('api.slider.slide.update')
        ->middleware('token-can:slider.slides.edit');

    $router->post('/delete', 'SlideController@delete')
        ->name('api.slider.slide.delete')
        ->middleware('token-can:slider.slides.destroy');
});

$router->group(['prefix' => '/slider'], function (Router $router) {
    $router->get('check', [
        'as' => 'api.slider.slider.test',
        'uses' => 'SlideController@test',
        //'middleware' => 'token-can:testimonial.testimonials.index',
    ]);
    
    $router->get('allslider', [
        'as' => 'api.slider.slider.index',
        'uses' => 'SlideController@index',
        //'middleware' => 'token-can:testimonial.testimonials.index',
    ]);
});
