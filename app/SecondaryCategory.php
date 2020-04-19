<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondaryCategory extends Model
{
    protected $fillable = ['title', 'description', 'primary_category_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function PrimaryCategory()
    {
        return $this->belongsTo('App\PrimaryCategory','primary_category_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Products()
    {
        return $this->hasMany('App\Product','secondary_category_id');
    }
}
