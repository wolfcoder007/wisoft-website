<?php

namespace Modules\Block\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Block\Events\BlockContentIsRendering;

class BlockTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title', 'author', 'content'];
    protected $table = 'block__block_translations';
    
    public function getContentAttribute($content)
    {
        event($event = new BlockContentIsRendering($content));

        return $event->getContent();
    }
    
}
