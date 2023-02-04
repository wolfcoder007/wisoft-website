<?php

namespace Modules\GeneralSettings\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use Translatable;

    protected $table = 'generalsettings__generalsettings';
    public $translatedAttributes = [];
    protected $fillable = [];
}
