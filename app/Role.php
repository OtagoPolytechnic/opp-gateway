<?php

namespace App;

use App\Group;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * Relationships
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
