<?php

namespace Modules\Smtp\Entities;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'smtp__providers';
    protected $fillable = ['provider_name','email_encryption', 'smtp_host', 'smtp_port', 'email', 'user_name', 'password', 'email_charset','others'];
}
