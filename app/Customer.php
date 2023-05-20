<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['user_id', 'address', 'district', 'province', 'postal_code', 'phone_number' ];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
