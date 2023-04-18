<?php

namespace Modules\Client\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

use Laracasts\Presenter\PresentableTrait;
use Modules\Client\Presenters\ClientPresenter;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Media\Entities\File;
use Modules\Media\Support\Traits\MediaRelation;


class Client extends Model
{
    
      
    use Translatable, MediaRelation, PresentableTrait, NamespacedEntity;
    public $translatedAttributes = ['name'];
    protected $fillable = ['category_id', 'status', 'name'];
    
    protected $presenter = ClientPresenter::class;
    protected $casts = [
        'is_home' => 'boolean',
        'status' => 'int',
    ];
    
    protected $table = 'client__clients';
    protected static $entityNamespace = 'asgardcms/client';
    
    /**
     * Get the thumbnail image for the current client post
     * @return File|string
     */
    public function getThumbnailAttribute()
    {
        $thumbnail = $this->files()->where('zone', 'thumbnail')->first();

        if ($thumbnail === null) {
            return '';
        }

        return $thumbnail;
    }

    public function getCanonicalUrl() : string
    {
        if ($this->is_home === true) {
            return url('/');
        }

        return route('client', $this->slug);
    }
    
    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeDraft(Builder $query)
    {
        return $query->whereStatus(Status::DRAFT);
    }

    /**
     * Check if the post is pending review
     * @param Builder $query
     * @return Builder
     */
    public function scopePending(Builder $query)
    {
        return $query->whereStatus(Status::PENDING);
    }

    /**
     * Check if the post is published
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query)
    {
        return $query->whereStatus(Status::PUBLISHED);
    }

    /**
     * Check if the post is unpublish
     * @param Builder $query
     * @return Builder
     */
    public function scopeUnpublished(Builder $query)
    {
        return $query->whereStatus(Status::UNPUBLISHED);
    }

    /**
     * @param $method
     * @param $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['asgard.client.config.client.relations', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }
}
