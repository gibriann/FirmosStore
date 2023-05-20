<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function purchase()
    {
        return $this->belongsTo('App\Purchase');
    }
}
