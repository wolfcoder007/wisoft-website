<?php

namespace Modules\Client\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Client\Listeners\RegisterClientSidebar;

use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Media\Image\ThumbnailManager;

class ClientServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterClientSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('clients', array_dot(trans('client::clients')));
            // append translations

        });


    }

    public function boot()
    {
        $this->publishConfig('client', 'permissions');
        $this->publishConfig('client', 'config');

        $this->registerThumbnails();

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
            'Modules\Client\Repositories\ClientRepository',
            function () {
                $repository = new \Modules\Client\Repositories\Eloquent\EloquentClientRepository(new \Modules\Client\Entities\Client());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Client\Repositories\Cache\CacheClientDecorator($repository);
            }
        );
// add bindings

    }
    
    private function registerThumbnails()
    {
        $this->app[ThumbnailManager::class]->registerThumbnail('blogThumb', [
            'fit' => [
                'width' => '150',
                'height' => '150',
                'callback' => function ($constraint) {
                    $constraint->upsize();
                },
            ],
        ]);
    }


}
