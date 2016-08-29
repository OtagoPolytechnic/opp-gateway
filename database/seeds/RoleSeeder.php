<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the roles Table
        Role::truncate();

        // Create some roles
        Role::create(['name' => 'Root']);
        Role::create(['name' => 'Office Admin']);
        Role::create(['name' => 'Lecturer']);
        Role::create(['name' => 'Student']);
    }
}
