<?php

namespace App;

use App\Calendar;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'calendar_id',
        'start_time',
        'duration',
        'place',
        'repeat_mode',
        'last_day_of_repetition',
        'repetition_id',
    ];

    protected $dates = [
        'start_time',
    ];
    
    /**
     * Override the create method so we can set the default repetition_id to the id
     * 
     * @param array $data
     * @return App\Event
     */
    public static function create(array $data = [])
    {
        // If the repetition_id is not empty, create the model instance normally
        if (!empty($data['repetition_id']))
            return parent::create($data);
        
        // If the repition_id is empty, set it to something and create the model instance
        $data['repetition_id'] = -1;
        $event = parent::create($data);

        // Now change the repetition_id to the auto-assigned ID and save
        $event->repetition_id = $event->id;
        $event->save();

        // Return the event
        return $event;
    }

    /**
     * Calendar this event belongs to
     *
     * @return Relation
     */
    public function Calendar()
    {
        return $this->belongsTo(Calendar::class);
    }
}
