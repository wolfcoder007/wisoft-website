<?php

namespace Modules\Seo\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use Translatable;

    protected $table = 'seo__seos';
    public $translatedAttributes = ['title'];
    protected $fillable = ['file_id', 'title', 'file_type'];
    
    protected static $entityNamespace = 'asgardcms/seo';
}
