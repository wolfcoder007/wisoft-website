<?php

namespace Modules\Industry\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Industry\Events\IndustryContentIsRendering;

class IndustryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'author', 'content'];
    protected $table = 'industry__industry_translations';
    
    public function getContentAttribute($content)
    {
        event($event = new IndustryContentIsRendering($content));

        return $event->getContent();
    }
}
