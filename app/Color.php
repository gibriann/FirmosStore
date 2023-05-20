<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'color_name',
    ];

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function purchased_products()
    {
        return $this->hasMany('App\PurchasedProduct');
    }
}
