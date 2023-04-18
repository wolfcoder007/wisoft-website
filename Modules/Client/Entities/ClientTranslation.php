<?php

namespace Modules\Client\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Client\Events\ClientContentIsRendering;

class ClientTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $table = 'client__client_translations';
    
    public function getContentAttribute($content)
    {
        event($event = new BlockContentIsRendering($content));

        return $event->getContent();
    }
}
