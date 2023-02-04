<?php

namespace Modules\Slider\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Slider\Events\SlideWasCreatedOrUpdated;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Modules\Slider\Entities\Slide;
use Modules\Slider\Repositories\SlideRepository;

class EloquentSlideRepository extends EloquentBaseRepository implements SlideRepository
{
    /**
     * Override for add the event on create and link media file
     *
     * @param mixed $data Data from POST request form
     *
     * @return object The created entity
     */
    public function create($data)
    {
        $slide = parent::create($data);

        event(new SlideWasCreatedOrUpdated($slide, $data));

        return $slide;
    }

    public function update($slide, $data)
    {
        parent::update($slide, $data);

        event(new SlideWasCreatedOrUpdated($slide, $data));

        return $slide;
    }
    
    public function allSlideData() {
        
        $data=   Slide::select('slider__sliders.id', 'slider__slides.id as slideId','t.id as localeId', 'slider__sliders.name as slider', 'slider__sliders.created_at','slider__slides.name as slide_name','slider__slides.external_image_url', 'slider__slides.youtube_video_url', 't.title', 't.locale', 't.caption', 't.custom_html',  'media__files.path')
        ->with('translations')
        ->join('slider__sliders', 'slider__sliders.id', '=', 'slider__slides.slider_id')
        ->leftJoin('slider__slide_translations as t', 't.id', '=', 'slider__slides.id')       
        ->leftJoin('media__imageables', 'media__imageables.imageable_id', '=', 'slider__slides.id')
        ->leftJoin('media__files', 'media__imageables.file_id', '=', 'media__files.id' )
        ->where('t.locale', locale())
        ->orwhere('t.locale')
        ->where('media__imageables.imageable_type', 'like' , '%Slider%')
        ->orWhereNull('media__imageables.imageable_type')
        ->groupBy('slider__sliders.id')
        ->get();

        
        return $data;
    }
}
