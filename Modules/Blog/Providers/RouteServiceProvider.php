<?php

namespace Modules\Blog\Providers;
use Illuminate\Support\Facades\Route;

use Modules\Core\Providers\RoutingServiceProvider as CoreRoutingServiceProvider;

class RouteServiceProvider extends CoreRoutingServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     * @var string
     */
    protected $namespace = 'Modules\Blog\Http\Controllers';

    /**
     * @return string
     */
    protected function getFrontendRoute()
    {
         return false;
        // return __DIR__ . '/../Routes/web.php';
    }

    /**
     * @return string
     */
    protected function getBackendRoute()
    {
        return __DIR__ . '/../Http/backendRoutes.php';
    }

    /**
     * @return string
     */
    protected function getApiRoute()
    {
        //return false;
        return __DIR__ . '/../Routes/api.php';
    }
}
