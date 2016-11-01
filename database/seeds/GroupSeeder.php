<?php

use Illuminate\Database\Seeder;
use App\PaperInstance;
use App\Group;
use App\Role;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the group table
        Group::truncate();

        //Get all PaperInstances
        $PaperInstances=PaperInstance::all();

        //Loop through all PaperInstances
        foreach($PaperInstances as $PaperInstance){
            //Create a lectures group and link to this paperInstance
            //Create a name
            $name = 'Lecturer: ';
            $name.= $PaperInstance->paper->name;
            //TODO Add date block here?

            $lg=Group::create(['paper_instance_id' => $PaperInstance->id,
                               'name' => $name,
                               'hidden' => false
                               ]);
            //Link PaperInstance to lecturer group
            $PaperInstance->lecturer_group_id = $lg->id;
            $PaperInstance->save();

            //Create a student group
            $name = 'Student: ';
            $name.= $PaperInstance->paper->name;

            $sg=Group::create(['paper_instance_id' => $PaperInstance->id,
                               'name' => $name,
                               'hidden' => false
                               ]);
        }
    }
}
