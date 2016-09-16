<?php

use Illuminate\Database\Seeder;
use App\Checkpoint;
use App\Gradebook;

class CheckpointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the roles Table
        Checkpoint::truncate();

        //Create a few checkpoints on one gradebook
        //Get gradebook
        $gradebook = DB::Gradebook()
    }
}
