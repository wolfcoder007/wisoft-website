<?php

namespace Modules\Client\Transformers;

use Modules\Client\Entities\Status;
use Modules\Client\Entities\Category;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientTransformer extends JsonResource
{
    /**
     * @var \Modules\Client\Entities\Status
     */
    protected $status;
    /**
     * @var \Modules\Client\Entities\Category
     */
    protected $category;
    /**
     * @var \Modules\Client\Repositories\PostRepository
     */
    private $post;
    
    private $file;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->post = app('Modules\Client\Repositories\ClientRepository');
        $this->status = app('Modules\Client\Entities\Status');
        $this->category = app('Modules\Client\Entities\Category');
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
            'created_at' => $this->resource->created_at->format('d-m-Y'),
            'status' => $this->status->get($this->resource->status),
            'category' => $this->category->get($this->resource->category_id),
            'name'  => $this->resource->name,
            
            'thumbnail' => $image_url,
            'urls' => [
                'delete_url' => route('api.clients.client.destroy', $this->resource->id),
            ],
        ];
    }
}
