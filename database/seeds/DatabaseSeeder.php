<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * use 'composer dump-autoload' when adding a new seeder!
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
        $this->call(DateBlockSeeder::class);
        $this->call(PaperInstanceSeeder::class);
        $this->call(GradebookSeeder::class);

        $this->call(CheckpointSeeder::class);

        //TODO Create a few checkpoint_user marks
        //TODO Create a few resources

        $this->call(GroupSeeder::class);

        // Set the DB back to normal
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        Model::reguard();
    }
}