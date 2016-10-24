<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaperInstance;
use App\Checkpoint;

class Gradebook extends Model
{
    protected $fillable = [
        'paper_instance_id',
    ];
    
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
    * Get all checkpoints in this Gradebook
    */
    public function checkpoints()
    {
        return $this->hasMany(Checkpoint::class);
    }

    /**
    * Add a new Checkpoint to this Gradebook
    */
    public function addCheckpoint($data)
    {   
        //TODO Data validation?
        $data['gradebook_id']=$this->id;
        return Checkpoint::create($data);
    }
}