<?php

use Illuminate\Database\Seeder;
use App\Paper;

class PaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the papers table
        Paper::truncate();

        // First year seeds
        Paper::create(['code' => 'IN511', 'name' => 'Programming 1']);
        Paper::create(['code' => 'IN512', 'name' => 'PC Maintenance']);
        Paper::create(['code' => 'IN523', 'name' => 'Professional Practice']);
        Paper::create(['code' => 'IN524', 'name' => 'Systems Analysis']);
        Paper::create(['code' => 'IN535', 'name' => 'Web 1']);
        Paper::create(['code' => 'IN536', 'name' => 'Maths for IT']);

        // Second year seeds
        Paper::create(['code' => 'IN611', 'name' => 'Programming 3']);
        Paper::create(['code' => 'IN613', 'name' => 'Software Engineering']);
        Paper::create(['code' => 'IN612', 'name' => 'Project Management']);
        Paper::create(['code' => 'IN655', 'name' => 'Databases 2']);
        Paper::create(['code' => 'IN673', 'name' => 'Web 2']);
        Paper::create(['code' => 'IN622', 'name' => 'Professional Practice 2']);

        // Third year seeds
        Paper::create(['code' => 'IN711', 'name' => 'OOSD']);
        Paper::create(['code' => 'IN710', 'name' => 'Algorithms and Data Structures']);
        Paper::create(['code' => 'IN708', 'name' => 'Project 1']);
        Paper::create(['code' => 'IN722', 'name' => 'Project 2']);
        Paper::create(['code' => 'IN731', 'name' => 'Web 2']);
        Paper::create(['code' => 'IN755', 'name' => 'Data Science and Machine Intelligence']);
    }
}
