<?php

namespace Modules\Smtp\Entities;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $table = 'smtp__templates';
    protected $fillable = ['template_name', 'body', 'provider_id', 'email_to', 'email_form','subject', 'header',];
}
