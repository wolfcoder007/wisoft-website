<?php

namespace Modules\Block\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Block\Listeners\RegisterBlockSidebar;

use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Media\Image\ThumbnailManager;

class BlockServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterBlockSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('blocks', array_dot(trans('block::blocks')));
            // append translations

        });


    }

    public function boot()
    {
        $this->publishConfig('block', 'permissions');
        $this->publishConfig('block', 'config');

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
            'Modules\Block\Repositories\BlockRepository',
            function () {
                $repository = new \Modules\Block\Repositories\Eloquent\EloquentBlockRepository(new \Modules\Block\Entities\Block());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Block\Repositories\Cache\CacheBlockDecorator($repository);
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
