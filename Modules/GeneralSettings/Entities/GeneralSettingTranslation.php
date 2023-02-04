<?php

namespace Modules\GeneralSettings\Entities;

use Illuminate\Database\Eloquent\Model;

class GeneralSettingTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'generalsettings__generalsetting_translations';
}
