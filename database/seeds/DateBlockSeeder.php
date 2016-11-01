<?php

use Illuminate\Database\Seeder;

use App\DateBlock;
use Carbon\Carbon;

class DateBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the events table
        DateBlock::truncate();

        DateBlock::create([
            'name' => 'Semester 1, 2016',
            'start_date' => Carbon::parse('22 February 2016'),
            'end_date' => Carbon::parse('17 June 2016'),
        ]);

        DateBlock::create([
            'name' => 'Semester 2, 2016',
            'start_date' => Carbon::parse('18 July 2016'),
            'end_date' => Carbon::parse('18 November 2016'),
        ]);
    }
}
