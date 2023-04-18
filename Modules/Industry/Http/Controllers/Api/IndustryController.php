<?php

namespace Modules\Industry\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Industry\Entities\Industry;
use Modules\Industry\Http\Requests\CreateIndustryRequest;
use Modules\Industry\Http\Requests\UpdateIndustryRequest;
use Modules\Industry\Repositories\IndustryRepository;
use Modules\Industry\Transformers\FullIndustryTransformer;
use Modules\Industry\Transformers\IndustryTransformer;
use Modules\Setting\Entities\Setting;


class IndustryController extends Controller
{
    /**
     * @var PageRepository
     */
    private $industry;

    public function __construct(IndustryRepository $industry)
    {
        $this->industry = $industry;
    }

    public function index()
    {
        $publishedIndustries = Industry::published()->get();
        return IndustryTransformer::collection($publishedIndustries);
    }

    public function industriespagination(Request $request)
    {
        return IndustryTransformer::collection($this->industry->serverPaginationFilteringFor($request));
    }
    
    public function find(Industry $industry)
    {
        return new FullIndustryTransformer($industry);
    }
    
    public function getSingleData($industry)
    {
        $industry = Industry::published()->find($industry);
        return IndustryTransformer::collection($industry);
    }


    
}
