<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaperInstance;

class Resource extends Model
{
    protected $fillable = [
        'paper_id',
        'name',
        'url',
    ];

    public function paper()
    {
        return $this->belongsTo(PaperInstance::class);
    }
}
