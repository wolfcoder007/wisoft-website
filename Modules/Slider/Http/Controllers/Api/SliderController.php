<?php

namespace Modules\Slider\Http\Controllers\Api;

use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Slider\Entities\Slider;
use Illuminate\Support\Facades\Response;
use Modules\Slider\Repositories\SlideRepository;
use Modules\Slider\Repositories\SliderRepository;
use Modules\Slider\Services\SlideOrderer;
use Modules\Slider\Transformers\FullSliderTransformer;
use Modules\Slider\Transformers\SliderTransformer;
use Modules\Slider\Transformers\SlideTransformer;

class SliderController extends Controller
{
    /**
     * @var Repository
     */
    private $cache;

    /**
     * @var SlideOrderer
     */
    private $slideOrderer;

    /**
     * @var SlideRepository
     */
    private $slide;
    
    /**
     * @var SliderRepository
     */
    private $slider;

    public function __construct(SlideOrderer $slideOrderer, Repository $cache, SlideRepository $slide, SliderRepository $slider)
    {
        $this->cache = $cache;
        $this->slideOrderer = $slideOrderer;
        $this->slide = $slide;
        $this->slider = $slider;
    }
    
    public function index()
    {
        $sliders = $this->slider->all();
        
       return SliderTransformer::collection($sliders);
    }
    
    public function getSliderData(Slider $slider){
        $slides = $slider->slides;
        return SlideTransformer::collection($slides);
    }

    
    /**
     * Update all slides
     * @param Request $request
     */
    public function update(Request $request)
    {
        $this->cache->tags('slides')->flush();

        $this->slideOrderer->handle($request->get('slider'));
    }

    /**
     * Delete a slide
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $slide = $this->slide->find($request->get('slide'));

        if (!$slide) {
            return Response::json(['errors' => true]);
        }

        $this->slide->destroy($slide);

        return Response::json(['errors' => false]);
    }
    
    
}
