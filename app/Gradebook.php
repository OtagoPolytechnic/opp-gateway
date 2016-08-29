<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gradebook extends Model
{
    //TODO Do we need this?
    public $timestamps = true;

    /**
    * Relationship to parent
    */
    public function paperInstance()
    {
        return $this->belongsTo(PaperInstance::class);
    }
}