<?php

use App\DateBlock;
use App\Paper;
use App\PaperInstance;
use App\Resource;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaperModelTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function createResource()
    {
        $paper = factory(Paper::class)->create();
        $resource = $paper->createResource([
            'name' => 'GitHub',
            'url' => 'https://google.com',
        ]);

        $expected = $resource->id;
        $actual = $paper->resources()->first()->id;

        $this->assertEquals($expected, $actual);
    }

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
    public function relationship_resources()
    {
        $paper = factory(Paper::class)->create();
        $resource = factory(Resource::class)->create(['paper_id' => $paper->id]);

        $expected = $resource->id;
        $actual = $paper->resources()->first()->id;

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
