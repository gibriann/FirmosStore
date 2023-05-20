<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrintingType extends Model
{
    protected $fillable = [
        'printing_name',
    ];


    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function purchased_products()
    {
        return $this->hasMany('App\PurchasedProduct', 'printing_id');
    }
}

