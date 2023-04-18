<?php

namespace Modules\Industry\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Industry\Listeners\RegisterIndustrySidebar;

use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Media\Image\ThumbnailManager;

class IndustryServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterIndustrySidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('industries', array_dot(trans('industry::industries')));
            // append translations

        });


    }

    public function boot()
    {
        $this->publishConfig('industry', 'permissions');
        $this->publishConfig('industry', 'config');

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
            'Modules\Industry\Repositories\IndustryRepository',
            function () {
                $repository = new \Modules\Industry\Repositories\Eloquent\EloquentIndustryRepository(new \Modules\Industry\Entities\Industry());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Industry\Repositories\Cache\CacheIndustryDecorator($repository);
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
