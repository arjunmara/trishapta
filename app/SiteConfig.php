<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
    protected $fillable = ['key', 'value', 'extra'];
}
