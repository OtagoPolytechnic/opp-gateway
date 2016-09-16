<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkpoint extends Model
{
    protected $fillable = [
        'gradebook_id',
        'weight',
        'date',
    ];

    /**
    * Relationships
    */
    public function gradebook()
    {
        return $this->belongsTo(Gradebook::class);
    }
}