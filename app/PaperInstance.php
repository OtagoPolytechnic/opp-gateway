<?php

namespace App;

use App\DateBlock;
use App\Group;
use App\Paper;
use App\User;
use App\Resource;
use Illuminate\Database\Eloquent\Model;

class PaperInstance extends Model
{
    protected $fillable = [
        'paper_id',
        'date_block_id',
        'lecturer_group_id',
    ];

    /**
     * Relationships
     */
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    public function dateBlock()
    {
        return $this->belongsTo(DateBlock::class);
    }

    /**
    * Get the lecturers group
    */
    public function lecturersGroup()
    {
        return $this->hasOne(Group::class, 'id', 'lecturer_group_id');
    }

    /**
    * Get all groups linked to this paper_instance
    */
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    /**
    * Get the student groups(all groups except the lecturers group)
    */
    public function studentsGroups(){
        return $this->hasMany(Group::class)->where('id', '!=', $this->lecturer_group_id);
    }

    /**
    * Get Gradebook for this PaperInstance
    */
    public function gradebook()
    {
        return $this->hasOne(Gradebook::class);
    }

    /**
     * Creates a new resource for this PaperInstance
     */
    public function createResource($data)
    {
        $data['paper_instance_id'] = $this->id;
        return Resource::create($data);
    }
}