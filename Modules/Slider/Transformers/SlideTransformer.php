<?php

namespace Modules\Slider\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SlideTransformer extends JsonResource
{
    private $file;
    
    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->slide = app('Modules\Slider\Repositories\SlideRepository');
        $this->file = app('Modules\Media\Repositories\FileRepository');
    }
    
    
    public function toArray($request)
    {
        $thumbnail = $this->file->findFileByZoneForEntity('slideImage', $this->resource);
        if(empty($thumbnail)) {
            $image_url = '';
        }else{
            $image_url = $thumbnail->getPathStringAttribute();
        }
        
        return [
            'id' => $this->resource->id,
            'created_at' => $this->resource->created_at->format('d-m-Y'),
            'name' => $this->resource->name,
            'image' => $image_url,
            'youtube_video_url' => $this->resource->youtube_video_url,
            
            'external_image_url' => $this->resource->external_image_url,
            'translations' => [
                'title' => optional($this->resource->translate(locale()))->title,
                'caption' => optional($this->resource->translate(locale()))->caption,
                'content' => optional($this->resource->translate(locale()))->custom_html,
            ]
            
        ];
    }
}
