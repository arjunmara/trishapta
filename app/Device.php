<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
   protected $fillable = ['mac_id','device_token','device_type'];
}
