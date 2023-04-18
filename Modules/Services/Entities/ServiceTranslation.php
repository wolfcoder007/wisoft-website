<?php

namespace Modules\Services\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Services\Events\ServiceContentIsRendering;

class ServiceTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'author', 'content'];
    protected $table = 'services__service_translations';
    
    public function getContentAttribute($content)
    {
        event($event = new ServiceContentIsRendering($content));

        return $event->getContent();
    }
}
