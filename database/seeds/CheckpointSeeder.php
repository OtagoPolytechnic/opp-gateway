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
        $gradebook = Gradebook::all()->first();

        $gradebook->addCheckpoint(['weight'=>'0.5','date'=>'2016-02-22']);
        $gradebook->addCheckpoint(['weight'=>'0.5','date'=>'2016-02-29']);
        $gradebook->addCheckpoint(['weight'=>'0.5','date'=>'2016-03-07']);
        $gradebook->addCheckpoint(['weight'=>'0.5','date'=>'2016-03-14']);
    }
}
