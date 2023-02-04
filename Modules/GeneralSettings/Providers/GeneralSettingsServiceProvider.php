<?php

namespace Modules\GeneralSettings\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\GeneralSettings\Listeners\RegisterGeneralSettingsSidebar;

class GeneralSettingsServiceProvider extends ServiceProvider
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
        //$this->app['events']->listen(BuildingSidebar::class, RegisterGeneralSettingsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('generalsettings', array_dot(trans('generalsettings::generalsettings')));
            // append translations

        });


    }

    public function boot()
    {
        $this->publishConfig('generalsettings', 'permissions');
        $this->publishConfig('generalsettings', 'settings');

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
            'Modules\GeneralSettings\Repositories\GeneralSettingRepository',
            function () {
                $repository = new \Modules\GeneralSettings\Repositories\Eloquent\EloquentGeneralSettingRepository(new \Modules\GeneralSettings\Entities\GeneralSetting());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\GeneralSettings\Repositories\Cache\CacheGeneralSettingDecorator($repository);
            }
        );
// add bindings

    }


}
