<?php

namespace Modules\CaseStudies\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\CaseStudies\Listeners\RegisterCaseStudiesSidebar;

use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Media\Image\ThumbnailManager;
//use Modules\Tag\Repositories\TagManager;

class CaseStudiesServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterCaseStudiesSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('casestudies', array_dot(trans('casestudies::casestudies')));
            // append translations

        });


    }

    public function boot()
    {
        $this->publishConfig('casestudies', 'permissions');
        $this->publishConfig('testimonials', 'config');

        $this->registerThumbnails();
       // $this->app[TagManager::class]->registerNamespace(new Post());
        //$this->registerViewComposers();

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
            'Modules\CaseStudies\Repositories\CaseStudiesRepository',
            function () {
                $repository = new \Modules\CaseStudies\Repositories\Eloquent\EloquentCaseStudiesRepository(new \Modules\CaseStudies\Entities\CaseStudies());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\CaseStudies\Repositories\Cache\CacheCaseStudiesDecorator($repository);
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
