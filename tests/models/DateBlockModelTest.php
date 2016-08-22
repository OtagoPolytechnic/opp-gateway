<?php

use App\DateBlock;
use App\Paper;
use App\PaperInstance;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DateBlockModelTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function relationship_paperInstances()
    {
        // Create the date block
        $dateBlock = factory(DateBlock::class)->create();

        // Create the paper instance
        $paper = factory(Paper::class)->create();
        $paperInstance = PaperInstance::create([
            'paper_id' => $paper->id,
            'date_block_id' => $dateBlock->id,
        ]);

        $expected = $dateBlock->paperInstances()->first()->id;
        $actual = $paperInstance->id;

        $this->assertEquals($expected, $actual);
    }
}
