<?php

namespace Modules\Smtp\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Smtp\Listeners\RegisterSmtpSidebar;

class SmtpServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterSmtpSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('providers', array_dot(trans('smtp::providers')));
            $event->load('templates', array_dot(trans('smtp::templates')));
            // append translations


        });


    }

    public function boot()
    {
        $this->publishConfig('smtp', 'permissions');

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
            'Modules\Smtp\Repositories\ProviderRepository',
            function () {
                $repository = new \Modules\Smtp\Repositories\Eloquent\EloquentProviderRepository(new \Modules\Smtp\Entities\Provider());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Smtp\Repositories\Cache\CacheProviderDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Smtp\Repositories\TemplateRepository',
            function () {
                $repository = new \Modules\Smtp\Repositories\Eloquent\EloquentTemplateRepository(new \Modules\Smtp\Entities\Template());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Smtp\Repositories\Cache\CacheTemplateDecorator($repository);
            }
        );
// add bindings


    }


}
