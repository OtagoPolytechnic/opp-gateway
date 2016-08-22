<?php

namespace App;

use App\Paper;
use App\PaperInstance;
use App\Roles;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'paper_instance_id',
        'name',
        'hidden',
    ];

    /**
     * Relationships
     */
    public function paperInstance()
    {
        return $this->belongsTo(PaperInstance::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
    }
}
