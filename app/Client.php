<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'email', 'password', 'address', 'sex', 'contact', 'date_of_birth', 'date_of_anniversary', 'office', 'office_address'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function schedule()
    {
        return $this->hasMany('App\Schedule','client_id');
    }

}
