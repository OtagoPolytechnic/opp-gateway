<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Resource;
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
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function instances()
    {
        return $this->hasMany(PaperInstance::class);
    }

    /**
     * Creates a new resource for this paper
     */
    public function createResource($data)
    {
        $data['paper_id'] = $this->id;
        return Resource::create($data);
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
