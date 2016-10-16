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

    public function createMark(User $user, $score)
    {
        $checkpointMark = ['checkpoint_id'=>$this->id,
                           'user_id'=>$user->id,
                           'score'=>$score];
        return Checkpoint_User::create($checkpointMark);
    }
}