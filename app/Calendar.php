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
    ];

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
}
