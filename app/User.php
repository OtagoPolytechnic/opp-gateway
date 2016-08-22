<?php

namespace App;

use App\Group;
use App\PaperInstance;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    /**
     * Relationships
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
