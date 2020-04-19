<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
   protected $fillable = ['title', 'body'];
}
