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
        return $this->belongsToMany(User::class);
    }

    /**
     * Check if this group has a particular role
     */
    public function hasRole($role)
    {
        // Find the number of times that role's id appears in the group->roles
        $countRoles = $this->roles()->where('role_id', $role->id)->count();

        // If the number returned is greater than one, this group has that role
        if ($countRoles > 0)
            return true;

        // Role not found
        return false;
    }
}
