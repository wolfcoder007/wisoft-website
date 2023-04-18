<?php

namespace Modules\Seo\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Seo\Listeners\RegisterSeoSidebar;

class SeoServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterSeoSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('seos', array_dot(trans('seo::seos')));
            // append translations

        });


    }

    public function boot()
    {
        $this->publishConfig('seo', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Seo\Repositories\SeoRepository',
            function () {
                $repository = new \Modules\Seo\Repositories\Eloquent\EloquentSeoRepository(new \Modules\Seo\Entities\Seo());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Seo\Repositories\Cache\CacheSeoDecorator($repository);
            }
        );
// add bindings

    }


}
