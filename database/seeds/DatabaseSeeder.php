<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Prep the DB for seeding
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Model::unguard(); // Temporally disable the mass-assignment protection of models

        $this->call(PaperSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        //Create a few date blocks
        //$this->call(DateBlockSeeder::class)


        //TODO Create a few paper instances
        //$this->call(PaperInstanceSeeder::class);
        //TODO Create a few gradebooks for the above paperInstances
        //TODO Create a few checkpoints
        //TODO Create a few checkpoint_user marks
        //TODO Create a few resources

        // Set the DB back to normal
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        Model::reguard();
    }
}
