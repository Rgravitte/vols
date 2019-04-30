<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountBalance extends Controller
{
    public function __construct($user_id, $ab)
    {
        $this->user_id = $user_id;
        $this->balance = $ab;
    }
}
