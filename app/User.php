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

    /**
     * Events in calendars this user subscribes to
     */
    public function events()
    {
        // Specify what we want to select
        $query = Event::select([
            'events.id as event_id',
            'events.name as event_name',
            'calendars.id as calendar_id',
            'calendars.name as calendar_name',
            'calendars.colour as colour',
            'events.start_time',
            'events.duration',
            'events.place',
            'events.repeat_mode',
            'events.last_day_of_repetition',
            'events.repetition_id'
        ]);
        
        // Grab all events and join with calendars
        $query->join('calendars', 'events.calendar_id', '=', 'calendars.id');

        // Join calendars on the calendar_subscriber pivot table
        $query->join('calendar_subscriber', 'calendars.id', '=', 'calendar_subscriber.calendar_id');

        // Only show events where the pivot tables user_id is the same as this user's id 
        $query->where('calendar_subscriber.user_id', $this->id);

        // Return all the events for this user
        return $query->get();
    }

    /**
     * Add an event to a calendar owned by this user
     */
    public function addEvent($calendar_id, $data)
    {
        $calendar = Calendar::findOrFail($calendar_id);

        $calendar->addEvent($data);
    }
}
