<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{
    //TODO Do we need this?
    public $timestamps = true;

    /**
    * Get the PaperInstance that this Gradebook belongs to
    */
    public function paperInstance()
    {
        return $this->belongsTo(PaperInstance::class);
    }

    /**
    * Get all checkpoints in this grade book
    */
    public function checkpoints()
    {
        return $this->hasMany(Checkpoint::class);
    }
}