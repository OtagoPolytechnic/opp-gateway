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
        DateBlock::create(['name' => 'S1Y2016', 'start_date' => '2016-01-01', 'end_date' => '2015-12-31']);
        //Year 2016 Semester 2

    }
}
