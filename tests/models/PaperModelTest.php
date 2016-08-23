<?php

use App\DateBlock;
use App\Paper;
use App\PaperInstance;
use App\Resource;

class PaperModelTest extends TestCase
{
    /**
     * @test
     */
    public function createInstance()
    {
        // Create the Paper
        $paper = factory(Paper::class)->create();

        // Create the Paper Instance
        $dateBlock = factory(DateBlock::class)->create();
        $instance = $paper->createInstance([
            'date_block_id' => $dateBlock->id,
        ]);

        $expected = $instance->id;
        $actual = $paper->instances()->first()->id;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function relationship_instances()
    {
        // Create the paper
        $paper = factory(Paper::class)->create();

        // Create the paper instance
        $dateBlock = factory(DateBlock::class)->create();
        $instance = PaperInstance::create([
            'paper_id' => $paper->id,
            'date_block_id' => $dateBlock->id,
        ]);

        $expected = $instance->id;
        $actual = $paper->instances()->first()->id;

        $this->assertEquals($expected, $actual);
    }
}
