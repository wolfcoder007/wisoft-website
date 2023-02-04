<?php

namespace Modules\CaseStudies\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CaseStudiesTransformer extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->resource->id,
            /*'is_home' => $this->resource->is_home,
            'template' => $this->resource->template,*/
            'created_at' => $this->resource->created_at->format('d-m-Y'),
            'check' => $this->resource->translate(locale()),
            'translations' => [
                'title' => optional($this->resource->translate(locale()))->title,
                'content' => optional($this->resource->translate(locale()))->content,
                'author' => optional($this->resource->translate(locale()))->author,
            ],
            'thumbnail' => url($this->resource->path),
            'urls' => [
                'delete_url' => route('api.casestudies.casestudies.destroy', $this->resource->id),
            ],
        ];
    }
}
