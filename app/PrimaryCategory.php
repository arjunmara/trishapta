<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrimaryCategory extends Model
{
    protected $fillable = ['title','description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function SecondaryCategories()
    {
      return  $this->hasMany('App\SecondaryCategory','primary_category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Products()
    {
        return $this->hasMany('App\Product','primary_category_id');
    }
}
