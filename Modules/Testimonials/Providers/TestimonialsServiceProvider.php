<?php

namespace Modules\Testimonials\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Testimonials\Listeners\RegisterTestimonialsSidebar;


use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Media\Image\ThumbnailManager;
//use Modules\Tag\Repositories\TagManager;

class TestimonialsServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterTestimonialsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('testimonials', array_dot(trans('testimonials::testimonials')));
            // append translations

        });


    }

    public function boot()
    {
        $this->publishConfig('testimonials', 'permissions');
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
            'Modules\Testimonials\Repositories\TestimonialRepository',
            function () {
                $repository = new \Modules\Testimonials\Repositories\Eloquent\EloquentTestimonialRepository(new \Modules\Testimonials\Entities\Testimonial());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Testimonials\Repositories\Cache\CacheTestimonialDecorator($repository);
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

  /*  private function registerViewComposers()
    {
        $this->app['view']->composer(
            config('asgard.blog.config.latest-posts', ['blog.*']),
            \Modules\Blog\Composers\Frontend\LatestPostsComposer::class
        );

        $this->app['view']->composer([
            'blog::admin.posts.create',
            'blog::admin.posts.edit',
        ], \Modules\Core\Composers\CurrentUserViewComposer::class);
    }*/


}
