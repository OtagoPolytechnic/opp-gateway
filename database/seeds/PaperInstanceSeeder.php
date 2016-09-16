<?php

use Illuminate\Database\Seeder;
use App\DateBlock;
use App\PaperInstance;
use App\Paper;

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

        PaperInstance::create(['paper_id' => Paper::where('code','IN511')->value('id'),
                          'date_block_id' => DateBlock::where('name','Y2016S1')->value('id')]);

        PaperInstance::create(['paper_id' => Paper::where('code','IN512')->value('id'),
                          'date_block_id' => DateBlock::where('name','Y2016S1')->value('id')]);

        PaperInstance::create(['paper_id' => Paper::where('code','IN523')->value('id'),
                          'date_block_id' => DateBlock::where('name','Y2016S1')->value('id')]);

        //Year 2016 Semester 2
        PaperInstance::create(['paper_id' => Paper::where('code','IN511')->value('id'),
                          'date_block_id' => DateBlock::where('name','Y2016S2')->value('id')]);

        PaperInstance::create(['paper_id' => Paper::where('code','IN512')->value('id'),
                          'date_block_id' => DateBlock::where('name','Y2016S2')->value('id')]);

        PaperInstance::create(['paper_id' => Paper::where('code','IN523')->value('id'),
                          'date_block_id' => DateBlock::where('name','Y2016S2')->value('id')]);

        PaperInstance::create(['paper_id' => Paper::where('code','IN524')->value('id'),
                          'date_block_id' => DateBlock::where('name','Y2016S2')->value('id')]);

        PaperInstance::create(['paper_id' => Paper::where('code','IN535')->value('id'),
                          'date_block_id' => DateBlock::where('name','Y2016S2')->value('id')]);

        PaperInstance::create(['paper_id' => Paper::where('code','IN536')->value('id'),
                          'date_block_id' => DateBlock::where('name','Y2016S2')->value('id')]);


        //TODO Add in lecturer_group_id?
    }
}
