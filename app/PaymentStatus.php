<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    public function purchase()
    {
        return $this->hasMany('App\Purchase');
    }
}
