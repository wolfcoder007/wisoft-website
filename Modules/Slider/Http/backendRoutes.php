<?php

use Illuminate\Routing\Router;

/** @var Router $router */

$router->bind('slider__slider', function ($id) {
    return app(\Modules\Slider\Repositories\SliderRepository::class)->find($id);
});
$router->bind('slider__slide', function ($id) {
    return app(\Modules\Slider\Repositories\SlideRepository::class)->find($id);
});



$router->group(['prefix' => '/slider'], function (Router $router) {
    $router->get('slider', [
        'as' => 'admin.slider.slide.index',
        'uses' => 'SlideController@index',
    ]);
});

$router->group(['prefix' => '/slider'], function (Router $router) {
   $router->get('sliders', [
        'as' => 'admin.slider.slider.index',
        'uses' => 'SliderController@index',
    ]);

    $router->get('sliders/create', [
        'as' => 'admin.slider.slider.create',
        'uses' => 'SliderController@create',
    ]);

    $router->post('sliders', [
        'as' => 'admin.slider.slider.store',
        'uses' => 'SliderController@store',
    ]);

    $router->get('sliders/{slider__slider}/edit', [
        'as' => 'admin.slider.slider.edit',
        'uses' => 'SliderController@edit',
    ]);

    $router->put('sliders/{slider__slider}', [
        'as' => 'admin.slider.slider.update',
        'uses' => 'SliderController@update',
    ]);

    $router->delete('sliders/{slider__slider}', [
        'as' => 'admin.slider.slider.destroy',
        'uses' => 'SliderController@destroy',
    ]);

    $router->get('sliders/{slider__slider}/slide/create', [
        'as' => 'admin.slider.slide.create',
        'uses' => 'SlideController@create',
    ]);

    $router->post('sliders/{slider__slider}/slide', [
        'as' => 'admin.slider.slide.store',
        'uses' => 'SlideController@store',
    ]);

    $router->get('sliders/{slider__slider}/slide/{slider__slide}/edit', [
        'as' => 'admin.slider.slide.edit',
        'uses' => 'SlideController@edit',
    ]);

    $router->put('sliders/{slider__slider}/slide/{slider__slide}', [
        'as' => 'admin.slider.slide.update',
        'uses' => 'SlideController@update',
    ]);

    $router->delete('sliders/{slider__slider}/slide/{slider__slide}', [
            'as' => 'admin.slider.slide.destroy',
            'uses' => 'SlideController@destroy',
    ]);

});

/*$router->group(['prefix' => '/slider'], function (Router $router) {
    $router->get('sliders', 'SliderController@index')
        ->name('admin.slider.slider.index')
        ->middleware('can:slider.sliders.index');

    $router->get('sliders/create', 'SliderController@create')
        ->name('admin.slider.slider.create')
        ->middleware('can:slider.sliders.create');//

    $router->post('sliders', 'SliderController@store')
        ->name('admin.slider.slider.store')
        ->middleware('can:slider.sliders.create');//

    $router->get('sliders/{slider__slider}/edit', 'SliderController@edit')
        ->name('admin.slider.slider.edit')
        ->middleware('can:slider.sliders.edit');//

    $router->put('sliders/{slider__slider}', 'SliderController@update')
        ->name('admin.slider.slider.update')
        ->middleware('can:slider.sliders.edit');//

    $router->delete('sliders/{slider__slider}', 'SliderController@destroy')
        ->name('admin.slider.slider.destroy')
        ->middleware('can:slider.sliders.destroy');//

    $router->get('sliders/{slider__slider}/slide/create', 'SlideController@create')
        ->name('admin.slider.slide.create')
        ->middleware('can:slider.slides.create');//

    $router->post('sliders/{slider__slider}/slide', 'SlideController@store')
        ->name('admin.slider.slide.store')
        ->middleware('can:slider.slides.create');//

    $router->get('sliders/{slider__slider}/slide/{slider__slide}/edit', 'SlideController@edit')
        ->name('admin.slider.slide.edit')
        ->middleware('can:slider.slides.edit');

    $router->put('sliders/{slider__slider}/slide/{slider__slide}', 'SlideController@update')
        ->name('admin.slider.slide.update')
        ->middleware('can:slider.slides.edit');

    $router->delete('sliders/{slider__slider}/slide/{slider__slide}', 'SlideController@destroy')
        ->name('admin.slider.slide.destroy')
        ->middleware('can:slider.slides.destroy');

});*/
