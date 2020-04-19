<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['primary_category_id', 'secondary_category_id', 'title','featured_image', 'features','is_featured', 'description','price', 'stock', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Images()
    {
        return $this->hasMany('App\ProductImage', 'product_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function PrimaryCategory()
    {
        return $this->belongsTo('App\PrimaryCategory');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function SecondaryCategory()
    {
        return $this->belongsTo('App\SecondaryCategory','secondary_category_id');
    }
}
