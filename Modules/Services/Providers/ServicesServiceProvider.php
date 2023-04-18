<?php

namespace Modules\Services\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Services\Listeners\RegisterServicesSidebar;

use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Media\Image\ThumbnailManager;

class ServicesServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterServicesSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('services', array_dot(trans('services::services')));
            // append translations

        });


    }

    public function boot()
    {
        $this->publishConfig('services', 'permissions'); 
        $this->publishConfig('services', 'config');

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
            'Modules\Services\Repositories\ServiceRepository',
            function () {
                $repository = new \Modules\Services\Repositories\Eloquent\EloquentServiceRepository(new \Modules\Services\Entities\Service());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Services\Repositories\Cache\CacheServiceDecorator($repository);
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
