<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['branch_name', 'location', 'description', 'status'];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
