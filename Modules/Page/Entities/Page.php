<?php

namespace Modules\Page\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Media\Support\Traits\MediaRelation;
use Modules\Tag\Contracts\TaggableInterface;
use Modules\Tag\Traits\TaggableTrait;

class Page extends Model implements TaggableInterface
{
    use Translatable, TaggableTrait, NamespacedEntity, MediaRelation;

    protected $table = 'page__pages';
    public $translatedAttributes = [
        'page_id',
        'title',
        'slug',
        'status',
        'body',
        'meta_title',
        'meta_description',
         'fb_title', 'fb_description', 'fb_type','fb_vedio_url','tw_title', 'tw_description', 'tw_card', 'cononical_url'
    ];
    protected $fillable = [
        'is_home',
        'template',
        // Translatable fields
        'page_id',
        'title',
        'slug',
        'status',
        'body',
        'meta_title',
        'meta_description',
        'fb_title', 'fb_description', 'fb_type','fb_vedio_url','tw_title', 'tw_description', 'tw_card', 'cononical_url'
    ];
    protected $casts = [
        'is_home' => 'boolean',
    ];
    protected static $entityNamespace = 'asgardcms/page';


    public function getCanonicalUrl() : string
    {
        if ($this->is_home === true) {
            return url('/');
        }

        return route('page', $this->slug);
    }

    public function getEditUrl() : string
    {
        return route('admin.page.page.edit', $this->id);
    }

    public function __call($method, $parameters)
    {
        #i: Convert array to dot notation
        $config = implode('.', ['asgard.page.config.relations', $method]);

        #i: Relation method resolver
        if (config()->has($config)) {
            $function = config()->get($config);

            return $function($this);
        }

        #i: No relation found, return the call to parent (Eloquent) to handle it.
        return parent::__call($method, $parameters);
    }

    public function getImageAttribute()
    {
        $thumbnail = $this->files()->where('zone', 'image')->first();

        if ($thumbnail === null) {
            return '';
        }

        return $thumbnail;
    }
    
    /**
     * Check if the post is published
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished(Builder $query)
    {
       // return $query->with('translations')->whereStatus('status', 1);
        return $query->join('page__page_translations as t', function ($join) {
                    $join->on('page__pages.id', '=', 't.page_id');
                })
                ->where('t.locale', locale())
                    ->where('t.status', 1);
        
        
    }

}
