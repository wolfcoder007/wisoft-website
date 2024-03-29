<?php

namespace Modules\Industry\Transformers;

use Modules\Industry\Entities\Status;
use Modules\Industry\Entities\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class IndustryTransformer extends JsonResource
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
     * @var \Modules\Industry\Repositories\IndustryRepository
     */
    private $industry;
    /* @var FileRepository
     */
    private $file;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->industry = app('Modules\Industry\Repositories\IndustryRepository');
        $this->status = app('Modules\Industry\Entities\Status');
        $this->category = app('Modules\Industry\Entities\Category');
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
                'delete_url' => route('api.industry.industry.destroy', $this->resource->id),
            ],
        ];
    }
}
