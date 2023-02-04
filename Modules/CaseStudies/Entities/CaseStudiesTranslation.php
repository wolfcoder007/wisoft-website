<?php

namespace Modules\CaseStudies\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\CaseStudies\Events\CaseStudiesContentIsRendering;

class CaseStudiesTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'author', 'content'];
    protected $table = 'casestudies__casestudies_translations';
    
    public function getContentAttribute($content)
    {
        event($event = new CaseStudiesContentIsRendering($content));

        return $event->getContent();
    }
}
