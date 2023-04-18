<?php

namespace Modules\Slider\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderTransformer extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            /*'is_home' => $this->resource->is_home,
            'template' => $this->resource->template,*/
            'created_at' => $this->resource->created_at->format('d-m-Y'),
            'slider_name' =>$this->resource->slider,
            'slide_name' =>$this->resource->slide_name,
            'thumbnail' => url($this->resource->path),
            'urls' => [
               // 'delete_url' => route('api.slide.slider.destroy', $this->resource->id),
            ],
        ];
    }
}
