<?php

namespace Modules\CaseStudies\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CaseStudies\Entities\CaseStudies;
use Modules\CaseStudies\Http\Requests\CreateCaseStudiesRequest;
use Modules\CaseStudies\Http\Requests\UpdateCaseStudiesRequest;
use Modules\CaseStudies\Repositories\CaseStudiesRepository;
use Modules\CaseStudies\Transformers\FullCaseStudiesTransformer;
use Modules\CaseStudies\Transformers\CaseStudiesTransformer;
use Modules\Setting\Entities\Setting;



class CaseStudiesController extends Controller
{
    /**
     * @var PageRepository
     */
    private $casestudies;

    public function __construct(CaseStudiesRepository $casestudies)
    {
        $this->casestudies = $casestudies;
    }

    public function index()
    {
       // var_dump($this->casestudies->allApiData());
        return CaseStudiesTransformer::collection($this->casestudies->allApiData());
    }

    public function casestudiespagination(Request $request)
    {
       // var_dump($this->casestudies->apiPaginationFilteringFor($request));
        return CaseStudiesTransformer::collection($this->casestudies->apiPaginationFilteringFor($request));
    }
    
    public function find(CaseStudies $casestudies)
    {
        return new FullCaseStudiesTransformer($casestudies);
    }
    
    public function getSingleData(CaseStudies $casestudies)
    {
        return new CaseStudiesTransformer($casestudies);
    }


}
