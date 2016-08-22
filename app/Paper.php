<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PaperInstance;

class Paper extends Model
{
    protected $fillable = [
        'name',
        'code',
    ];

    /**
     * Relationships
     */
    public function instances()
    {
        return $this->hasMany(PaperInstance::class);
    }

    /**
     * Creates a new PaperInstance object for this paper
     */
    public function createInstance($data)
    {
        $data['paper_id'] = $this->id;
        return PaperInstance::create($data);
    }
}
