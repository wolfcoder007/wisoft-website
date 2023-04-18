<?php

namespace Modules\Services\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Services\Entities\Service;
use Modules\Services\Http\Requests\CreateServiceRequest;
use Modules\Services\Http\Requests\UpdateServiceRequest;
use Modules\Services\Repositories\ServiceRepository;
use Modules\Services\Transformers\FullServiceTransformer;
use Modules\Services\Transformers\ServiceTransformer;
use Modules\Setting\Entities\Setting;



class ServiceController extends Controller
{
    /**
     * @var PageRepository
     */
    private $service;

    public function __construct(ServiceRepository $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $publishedPosts = Service::published()->get();
        return ServiceTransformer::collection($publishedPosts);
    }

    public function servicespagination(Request $request)
    {
        return ServiceTransformer::collection($this->service->serverPaginationFilteringFor($request));
    }
    
    public function find(Service $service)
    {
        return new FullServiceTransformer($service);
    }
    
    public function getSingleData(Service $service)
    {
        return new ServiceTransformer($service);
    }


    
}
