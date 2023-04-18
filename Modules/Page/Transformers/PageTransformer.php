<?php

namespace Modules\Page\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class PageTransformer extends JsonResource
{
    /**
     * @var BlockRepository
     */
    private $page;
    /* @var FileRepository
     */
    private $file;

    public function __construct($entity )
    {
        parent::__construct($entity);
        $this->page = app('Modules\Page\Repositories\PageRepository');
        $this->file = app('Modules\Media\Repositories\FileRepository');
    }
    public function toArray($request)
    {
        $image_data = $this->file->findFileByZoneForEntity('image', $this->resource);
        if(empty($image_data)) {
            $image_url = '';
        }else{
            $image_url = $image_data->getPathStringAttribute();
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
            'is_home' => $this->resource->is_home,
            'template' => $this->resource->template,
            'created_at' => $this->resource->created_at->format('d-m-Y'),
            'check' => $this->resource->translate(locale()),
            'translations' => [
                'title' => optional($this->resource->translate(locale()))->title,
                'slug' => optional($this->resource->translate(locale()))->slug,
                'status' => optional($this->resource->translate(locale()))->status,
                //'body' => optional($this->resource->translate(locale()))->body,
            ],
            'feacher_image' => $image_url,
            'facebook_image'      => $fb_image_url,
            'twitter_image'      => $tw_image_url,
            'urls' => [
                'delete_url' => route('api.page.page.destroy', $this->resource->id),
            ],
        ];
    }
}
