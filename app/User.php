<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\PaperInstance;
use App\Stream;

class User extends Authenticatable
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
