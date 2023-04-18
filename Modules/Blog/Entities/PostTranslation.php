<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Events\PostContentIsRendering;

class PostTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'slug', 'content','meta_title', 'meta_description', 'fb_title', 'fb_description', 'fb_type','fb_vedio_url','tw_title', 'tw_description', 'tw_card', 'cononical_url'];
    protected $table = 'blog__post_translations';

    public function getContentAttribute($content)
    {
        event($event = new PostContentIsRendering($content));

        return $event->getContent();
    }
}
