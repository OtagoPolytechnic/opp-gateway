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
        //Leave one of the paper instance without a gradebook
        //$this->createGradebook('IN512', 'Y2016S1');
        $this->createGradebook('IN523', 'Y2016S1');

        //Do Y2016S2 papers
        $this->createGradebook('IN511', 'Y2016S2');
        $this->createGradebook('IN512', 'Y2016S2');
        //Leave this one blank, only exists in semester 1
        //$this->createGradebook('IN523', 'Y2016S2');
        $this->createGradebook('IN524', 'Y2016S2');
        $this->createGradebook('IN535', 'Y2016S2');
        $this->createGradebook('IN536', 'Y2016S2');
    }

    /**
     * Create a Gradebook given the paper code and the dateblock the paper is in
     * There is no check that a paper instance exists for the given paper and dateblock!
     * TODO Throw exception on missing PaperInstance
     *
     * @param string $paper_code The code for a Paper
     * @param string $date_block The name of a DateBlock
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
