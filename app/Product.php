<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'product_image', 'product_price', 'product_weight', 'product_description', 'slug',
    ];

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function purchased_product()
    {
        return $this->hasMany('App\PurchasedProduct');
    }
}
