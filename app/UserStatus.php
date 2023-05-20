<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $fillable = [
        'status_user_name',
    ];

    public function user()
    {
        return $this->hasMany('App\User');
    }
}
