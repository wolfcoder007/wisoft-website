<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

/** @var Router $router */
//$router->group(['prefix' => '/page', 'middleware' => ['api.token', 'auth.admin']], function (Router $router) {
$router->group(['prefix' => '/testimonial'], function (Router $router) {
    $router->get('alltestimonials', [
        'as' => 'api.testimonial.testimonial.index',
        'uses' => 'TestimonialController@index',
        //'middleware' => 'token-can:testimonial.testimonials.index',
    ]);
    
    $router->get('testimonial/{testimonial}', [
        'as' => 'api.testimonial.testimonial.getSingleData',
        'uses' => 'TestimonialController@getSingleData',
        //'middleware' => 'token-can:testimonial.testimonials.index',
    ]);
    
    
    $router->get('testimonials', [
        'as' => 'api.testimonial.testimonial.testimonialspagination',
        'uses' => 'TestimonialController@testimonialspagination',
        //'middleware' => 'token-can:testimonial.testimonials.index',
    ]);
    /*$router->get('mark-pages-status', [
        'as' => 'api.page.page.mark-status',
        'uses' => 'UpdatePageStatusController',
      //  'middleware' => 'token-can:page.pages.edit',
    ]);*/
    $router->delete('testimonials/{testimonial}', [
        'as' => 'api.testimonial.testimonial.destroy',
        'uses' => 'TestimonialController@destroy',
        //'middleware' => 'token-can:testimonial.testimonials.destroy',
    ]);
    /*$router->post('pages', [
        'as' => 'api.page.page.store',
        'uses' => 'PageController@store',
        'middleware' => 'token-can:page.pages.create',
    ]);
    $router->post('pages/{page}', [
        'as' => 'api.page.page.find',
        'uses' => 'PageController@find',
        'middleware' => 'token-can:page.pages.edit',
    ]);
    $router->post('pages/{page}/edit', [
        'as' => 'api.page.page.update',
        'uses' => 'PageController@update',
        'middleware' => 'token-can:page.pages.edit',
    ]);
    $router->get('templates', 'PageTemplatesController')->name('api.page.page-templates.index');*/
});
