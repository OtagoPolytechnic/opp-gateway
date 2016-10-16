<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkpoint_User extends Model
{
    protected $fillable = [
        'checkpoint_id',
        'user_id',
        'score',
        ];

    protected $table = 'checkpoint_user';
    //TODO Relationships?
}
