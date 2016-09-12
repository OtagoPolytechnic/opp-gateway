<?php

use Illuminate\Database\Seeder;
use App\DateBlock;
use App\PaperInstance;

class PaperInstanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the dateblock table
        PaperInstance::truncate();


        //Year 2016 Semester 1
        $y2010s1 = DB::table('date_blocks')->where('name', 'Y2016S1')->first();

        //TODO Add paper instances here

        //Year 2016 Semester 2
        $y2010s2 = DB::table('date_blocks')->where('name', 'Y2016S1')->first();

        //TODO Add paper instances here
    }
}
