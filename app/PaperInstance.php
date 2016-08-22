<?php

namespace App;

use App\DateBlock;
use App\Paper;
use App\Stream;
use App\User;
use Illuminate\Database\Eloquent\Model;

class PaperInstance extends Model
{
    protected $fillable = [
        'paper_id',
        'date_block_id',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    public function dateBlock()
    {
        return $this->belongsTo(DateBlock::class);
    }
}
