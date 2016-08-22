<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaperInstance;

class Resource extends Model
{
    protected $fillable = [
        'paper_instance_id',
        'name',
        'url',
    ];

    /**
     * Relationships
     */
    public function paper()
    {
        return $this->belongsTo(PaperInstance::class);
    }
}
