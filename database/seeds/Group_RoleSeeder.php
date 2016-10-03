<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\PaperInstance;

class Group_RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the group_role table
        DB::table('group_role')->truncate();

        //Get all PaperInstances
        $PaperInstances=PaperInstance::all();

        //Get Lecturer Role
        $LecturerRole = Role::where('name', 'Lecturer')->first();
        //Get Student Role
        $StudentRole = Role::where('name', 'Student')->first();

        //Loop through all PaperInstances
        foreach($PaperInstances as $PaperInstance){
            //Get all lecturer groups for this paper instance and assign LecturerRole
            $PaperInstance->lecturersGroup->roles()->attach($LecturerRole->id);$g->

            //Get all student groups for this paper instance and assign StudentRole
            foreach($PaperInstance->groups as $StudentGroup){
                $StudentGroup->roles()->attach($StudentRole->id);
            }
        }
    }
}