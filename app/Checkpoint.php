<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkpoint extends Model
{
    protected $fillable = [
        'gradebook_id',
        'name',
        'weight',
        'total',
        'date',
    ];

    /**
    * Relationships
    */
    public function gradebook()
    {
        return $this->belongsTo(Gradebook::class);
    }

    public function createScore(User $user, $score)
    {
        $checkpointScore = ['checkpoint_id'=>$this->id,
                           'user_id'=>$user->id,
                           'score'=>$score];
        return Checkpoint_User::create($checkpointScore);
    }

    public function deleteScore(User $user)
    {
        //Find score
        $checkpointScore = ['checkpoint_id'=>$this->id,
                            'user_id'=>$user->id];

        $cp=Checkpoint_User::where($checkpointScore)->first();

        return $cp->delete();
    }
    //TODO place patchScore in here!
}