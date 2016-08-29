<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the users table
        User::truncate();


        User::create(['first_name' => 'John', 'last_name' => 'Smith', 'email' => 'john.smith@example.com']);
        User::create(['first_name' => 'Mary', 'last_name' => 'Jackson', 'email' => 'mary.jackson@example.com']);
        User::create(['first_name' => 'Aaron', 'last_name' => 'Martin', 'email' => 'aaron.martin@example.com']);
    }
}
