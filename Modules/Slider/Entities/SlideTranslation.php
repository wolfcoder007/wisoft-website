<?php

namespace Modules\Slider\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Slider\Events\SlideContentIsRendering;

class SlideTranslation extends Model
{
    public $fillable = [
        'title',
        'caption',
        'uri',
        'url',
        'active',
        'custom_html',
    ];

    protected $table = 'slider__slide_translations';
    
    public function getContentAttribute($content)
    {
        event($event = new SlideContentIsRendering($content));

        return $event->getContent();
    }
}
