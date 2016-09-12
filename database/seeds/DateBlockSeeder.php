<?php

use Illuminate\Database\Seeder;
use App\DateBlock;

class DateBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the dateblock table
        DateBlock::truncate();


        //Year 2016 Semester 1
        DateBlock::create(['name' => 'Y2016S1', 'start_date' => '2016-02-15', 'end_date' => '2016-06-15']);
        //Year 2016 Semester 2
        DateBlock::create(['name' => 'Y2016S2', 'start_date' => '2016-07-18', 'end_date' => '2016-11-18']);
    }
}
