<?php

use Illuminate\Database\Seeder;
use App\Gradebook;
use App\Paper;
use App\PaperInstance;
use App\DateBlock;

class GradebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the users table
        Gradebook::truncate();

        //Do Y2016S1 papers
        $this->createGradebook('IN511', 'Y2016S1');

        // Gradebook::create(['paper_instances_id' =>
        //     PaperInstance::where('paper_id', Paper::where('code','IN511')->value('id'))->
        //     where('date_block_id' , $semester1)->value('id')
        //     ]);
    }

    /**
     * Create a Gradebook given the paper code and the dateblock the paper is in
     * There is no check that a paper instance exists for the given paper and dateblock!
     * TODO Add params
     * @return void
     */
    public function createGradebook($paper_code, $date_block)
    {
        //Get paper_id
        $paper_id = Paper::where('code', $paper_code)->value('id');
        //Get date_block_id
        $date_block_id = DateBlock::where('name', $date_block)->value('id');

        //Create Gradebook
            Gradebook::create(['paper_instances_id' =>
            PaperInstance::where('paper_id', $paper_id)->
                           where('date_block_id' , $date_block_id)->value('id')
            ]);
    }
}
