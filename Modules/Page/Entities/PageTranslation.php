<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Page\Events\PageContentIsRendering;

class PageTranslation extends Model
{
    protected $table = 'page__page_translations';
    protected $fillable = [
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
        'status' => 'boolean',
    ];

    public function getBodyAttribute($body)
    {
        event($event = new PageContentIsRendering($body));

        return $event->getBody();
    }
}
