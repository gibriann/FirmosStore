<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    protected $guarded = ['id'];

    public function purchase()
    {
        return $this->belongsTo('App\Purchase');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function size()
    {
        return $this->belongsTo('App\Size');
    }

    public function color()
    {
        return $this->belongsTo('App\Color');
    }

    public function printingtype()
    {
        return $this->belongsTo('App\PrintingType', 'printing_id');
    }
}
