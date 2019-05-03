<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{

    protected $fillable = [
        'first_user', 'second_user', 'acted_user', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sendFriendRequest(array $data)
    {

    }
}
