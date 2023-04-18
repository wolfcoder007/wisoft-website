<?php

namespace Modules\Blog\Transformers;

use Modules\Blog\Entities\Status;
use Illuminate\Http\Resources\Json\JsonResource;

class PostTransformer extends JsonResource
{
    /**
     * @var \Modules\Blog\Entities\Status
     */
    protected $status;
    /**
     * @var \Modules\Blog\Entities\Category
     */
   // protected $category;
    /**
     * @var \Modules\Blog\Repositories\PostRepository
     */
    /**
     * @var BlockRepository
     */
    private $post;
    /* @var FileRepository
     */
    private $file;

    public function __construct($entity )
    {
        parent::__construct($entity);
        $this->post = app('Modules\Blog\Repositories\PostRepository');
        $this->status = app('Modules\Blog\Entities\Status');
       // $this->category = app('Modules\Block\Entities\Category');
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

        $fb_image = $this->file->findFileByZoneForEntity('fb_image', $this->resource);
        if(empty($fb_image)) {
            $fb_image_url = '';
        }else{
            $fb_image_url = $fb_image->getPathStringAttribute();
        }

        $tw_image = $this->file->findFileByZoneForEntity('tw_image', $this->resource);
        if(empty($tw_image)) {
            $tw_image_url = '';
        }else{
            $tw_image_url = $tw_image->getPathStringAttribute();
        }
            
        return [
            'id' => $this->resource->id,
            /*'is_home' => $this->resource->is_home,
            'template' => $this->resource->template,*/
            'created_at' => $this->resource->created_at->format('d-m-Y'),
            'check' => $this->resource->translate(locale()),
            'status' => $this->status->get($this->resource->status),
           // 'category' => $this->category->get($this->resource->category_id),
            'translations' => [
                'title' => optional($this->resource->translate(locale()))->title,
                'content' => optional($this->resource->translate(locale()))->content,
                'author' => optional($this->resource->translate(locale()))->author,
            ],
            'feacher_image' => $image_url,
            'facebook_image'      => $fb_image_url,
            'twitter_image'      => $tw_image_url,
            'urls' => [
                'delete_url' => route('api.blocks.block.destroy', $this->resource->id),
            ],
        ];
    }
}
