<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $guarded = ['id'];

    public function purchased_product()
    {
        return $this->hasMany('App\PurchasedProduct');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function statusPayment()
    {
        return $this->belongsTo('App\PaymentStatus', 'payment_status_id');
    }

    public function statusShipping()
    {
        return $this->belongsTo('App\ShippingStatus', 'shipping_status_id');
    }

}


