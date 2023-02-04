<?php

namespace Modules\Testimonials\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Testimonials\Entities\Testimonial;
use Modules\Testimonials\Http\Requests\CreateTestimonialRequest;
use Modules\Testimonials\Http\Requests\UpdateTestimonialRequest;
use Modules\Testimonials\Repositories\TestimonialRepository;
use Modules\Testimonials\Transformers\FullTestimonialTransformer;
use Modules\Testimonials\Transformers\TestimonialTransformer;
use Modules\Setting\Entities\Setting;



class TestimonialController extends Controller
{
    /**
     * @var PageRepository
     */
    private $testimonial;

    public function __construct(TestimonialRepository $testimonial)
    {
        $this->testimonial = $testimonial;
    }

    public function index()
    {
        //var_dump($this->testimonial->check_data());
        return TestimonialTransformer::collection($this->testimonial->allApiData());
    }

    public function testimonialspagination(Request $request)
    {
       // var_dump($this->testimonial->apiPaginationFilteringFor($request));
        return TestimonialTransformer::collection($this->testimonial->apiPaginationFilteringFor($request));
    }
    
    public function find(Testimonial $testimonial)
    {
        return new FullTestimonialTransformer($testimonial);
    }
    
    public function getSingleData(Testimonial $testimonial)
    {
        return new TestimonialTransformer($testimonial);
    }


    /*public function store(CreatePageRequest $request)
    {
        $this->testimonial->create($request->all());

        return response()->json([
            'errors' => false,
            'message' => trans('page::messages.page created'),
        ]);
    }

    
    public function update(Page $page, UpdatePageRequest $request)
    {
        $this->testimonial->update($page, $request->all());

        return response()->json([
            'errors' => false,
            'message' => trans('page::messages.page updated'),
        ]);
    }

    public function destroy(Page $page)
    {
        $this->testimonial->destroy($page);

        return response()->json([
            'errors' => false,
            'message' => trans('page::messages.page deleted'),
        ]);
    }*/
}
