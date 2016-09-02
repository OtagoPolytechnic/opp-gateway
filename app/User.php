<?php

namespace App;

use App\Calendar;
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
     * Groups this user belongs to
     *
     * @return Relation
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Roles that belong directly to this user (a user may also have roles through a group)
     *
     * @return Relation
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Calendars that this user is the owner of
     *
     * @return Relation
     */
    public function ownedCalendars()
    {
        return $this->hasMany(Calendar::class, 'owner_id');
    }

    /**
     * Calendars this user is subscribed to
     *
     * @return Relation
     */
    public function subscribedCalendars()
    {
        return $this->belongsToMany(Calendar::class, 'calendar_subscriber');
    }
}
