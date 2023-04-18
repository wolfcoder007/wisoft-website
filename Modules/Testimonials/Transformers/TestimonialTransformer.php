<?php

namespace Modules\Testimonials\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Testimonials\Entities\Status;
use Modules\Testimonials\Entities\Category;

class TestimonialTransformer extends JsonResource
{
    /**
     * @var \Modules\Blog\Entities\Status
     */
    protected $status;
    /**
     * @var \Modules\Blog\Entities\Category
     */
    protected $category;
    /**
     * @var \Modules\Testimonials\Repositories\TestimonialRepository
     */
    private $testimonial;
    /* @var FileRepository
     */
    private $file;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->testimonial = app('Modules\Testimonials\Repositories\TestimonialRepository');
        $this->status = app('Modules\Testimonials\Entities\Status');
        $this->category = app('Modules\Testimonials\Entities\Category');
        $this->file = app('Modules\Media\Repositories\FileRepository');
    }
    
    public function toArray($request)
    {
        $thumbnail = $this->file->findFileByZoneForEntity('thumbnail', $this->resource);
        if(empty($thumbnail)) {
            $image_url = '';
        }else{
            $image_url = $thumbnail->getPathStringAttribute();
        }
        
        return [
            'id' => $this->resource->id,
            /*'is_home' => $this->resource->is_home,
            'template' => $this->resource->template,*/
            'created_at' => $this->resource->created_at->format('d-m-Y'),
            'check' => $this->resource->translate(locale()),
            'status' => $this->status->get($this->resource->status),
            'category' => $this->category->get($this->resource->category_id),
            'translations' => [
                'title' => optional($this->resource->translate(locale()))->title,
                'content' => optional($this->resource->translate(locale()))->content,
                'author' => optional($this->resource->translate(locale()))->author,
            ],
            'thumbnail' => $image_url,
            'urls' => [
                'delete_url' => route('api.testimonial.testimonial.destroy', $this->resource->id),
            ],
        ];
    }
}
