<?php

namespace Modules\Block\Transformers;

use Modules\Block\Entities\Status;
use Modules\Block\Entities\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class BlockTransformer extends JsonResource
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
     * @var \Modules\Blog\Repositories\PostRepository
     */
    /**
     * @var BlockRepository
     */
    private $block;
    /* @var FileRepository
     */
    private $file;

    public function __construct($entity )
    {
        parent::__construct($entity);
        $this->block = app('Modules\Block\Repositories\BlockRepository');
        $this->status = app('Modules\Block\Entities\Status');
        $this->category = app('Modules\Block\Entities\Category');
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
                'delete_url' => route('api.blocks.block.destroy', $this->resource->id),
            ],
        ];
    }
}
