<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class AccountBalance extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = [
        'balance' => 0.00
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
