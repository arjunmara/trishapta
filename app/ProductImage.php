<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id','title'];

    public function Product()
    {
        return $this->belongsTo('App\Product');
    }
}
