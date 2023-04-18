<?php

namespace Modules\Seo\Entities;

use Illuminate\Database\Eloquent\Model;

class SeoTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['title'];
    protected $table = 'seo__seo_translations';
}
