<?php

namespace Modules\Slider\Repositories\Eloquent;

use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;
use Modules\Slider\Entities\Slider;
use Modules\Slider\Entities\Slide;
use Modules\Slider\Repositories\SliderRepository;

class EloquentSliderRepository extends EloquentBaseRepository implements SliderRepository
{
    public function create($data)
    {
        $slider = $this->model->create($data);

        return $slider;
    }

    public function update($slider, $data)
    {
        $slider->update($data);

        return $slider;
    }

    /**
     * Count all records
     * @return int
     */
    public function countAll()
    {
        return $this->model->count();
    }

    /**
     * Get all available sliders
     * @return object
     */
    public function allOnline()
    {
        return $this->model->where('active', '=', true)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @param string $systemName
     * @return Slider
     */
    public function findBySystemName($systemName)
    {
        return $this->model->where('system_name', '=', $systemName)->first();
    }
    
    /*public function allSliderData() {
        
        return $this->model->select('slider__sliders.id', 'slide.id as slideId','t.id as localeId', 'slider__sliders.name as slider', 'slider__sliders.created_at','slide.name as slide_name','slide.external_image_url', 'slide.youtube_video_url', 't.title', 't.locale', 't.caption', 't.custom_html',  'media__files.path')
        ->join('slider__slides as slide', 'slide.slider_id', '=', 'slider__sliders.id')
        ->leftJoin('slider__slide_translations as t', 't.id', '=', 'slide.id')       
        ->leftJoin('media__imageables', 'media__imageables.imageable_id', '=', 'slide.id')
        ->leftJoin('media__files', 'media__imageables.file_id', '=', 'media__files.id' )
        ->where('t.locale', locale())
        ->orwhere('t.locale')
        ->where('media__imageables.imageable_type', 'like' , '%Slider%')
        ->orWhereNull('media__imageables.imageable_type')
        ->get();

        
       // return $data;
    }*/
}
