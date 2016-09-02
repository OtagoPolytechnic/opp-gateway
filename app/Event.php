<?php

namespace App;

use App\Calendar;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
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
     * Calendar this event belongs to
     *
     * @return Relation
     */
    public function Calendar()
    {
        return $this->belongsTo(Calendar::class);
    }
}
