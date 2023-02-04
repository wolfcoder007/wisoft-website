<?php

namespace Modules\Blog\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Blog\Listeners\RegisterBlogSidebar;
use Modules\Media\Image\ThumbnailManager;
use Modules\Tag\Repositories\TagManager;

use Modules\Blog\Entities\Category;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\Tag;

class BlogServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterBlogSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('categories', array_dot(trans('blog::categories')));
            $event->load('posts', array_dot(trans('blog::posts')));
            // append translations


        });


    }

    public function boot()
    {
       //$this->publishConfig('blog', 'permissions');
        $this->publishConfig('blog', 'config');
        $this->publishConfig('blog', 'permissions');
        $this->publishConfig('blog', 'settings');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->registerThumbnails();
        // $this->app[TagManager::class]->registerNamespace(new Post());
       //   $this->registerViewComposers();
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
            'Modules\Blog\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Blog\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Blog\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Blog\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Blog\Repositories\PostRepository',
            function () {
                $repository = new \Modules\Blog\Repositories\Eloquent\EloquentPostRepository(new \Modules\Blog\Entities\Post());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Blog\Repositories\Cache\CachePostDecorator($repository);
            }
        );
// add bindings

        $this->app->bind(
            'Modules\Blog\Repositories\TagRepository',
            function () {
                $repository = new \Modules\Blog\Repositories\Eloquent\EloquentTagRepository(new \Modules\Blog\Entities\Tag());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Blog\Repositories\Cache\CacheTagDecorator($repository);
            }
        );


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