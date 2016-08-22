<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaperInstance;

class DateBlock extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
    ];

    protected $dates = [
        'start_date',
        'end_date',
    ];

    /**
     * Relationships
     */
    public function paperInstances()
    {
        return $this->hasMany(PaperInstance::class);
    }
}
