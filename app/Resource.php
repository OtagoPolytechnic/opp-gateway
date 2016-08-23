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
    public function paperInstance()
    {
        return $this->belongsTo(PaperInstance::class);
    }
}
