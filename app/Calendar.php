<?php

namespace App;

use App\Event;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $fillable = [
        'owner_id',
        'name',
        'colour',
    ];
    
    /**
     * Override the create method so we can automatically subscribe the owner
     * 
     * @param array $data
     * @return App\Calendar
     */
    public static function create(array $data = [])
    {
        // Create the calendar normally
        $calendar = parent::create($data);

        // Add the calendar owner as a subscriber
        $calendar->subscribers()->attach($data['owner_id']);

        // Return the calendar
        return $calendar;
    }

    /**
     * User that owns this calendar
     *
     * @return Relation
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Users that subscribe to this calendar
     *
     * @return Relation
     */
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'calendar_subscriber');
    }

    /**
     * Events for this calendar
     *
     * @return Relation
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * Add an event to this calendar
     */
    public function addEvent($data)
    {
        $data['calendar_id'] = $this->id;
        $this->events()->create($data);
    }
}
