<?php

use App\DateBlock;
use App\Group;
use App\Paper;
use App\PaperInstance;
use App\Resource;
use App\User;

class PaperInstanceModelTest extends TestCase
{
    /**
     * @test
     */
    public function createResource()
    {
        $paperInstance = factory(PaperInstance::class)->create();
        $resource = $paperInstance->createResource([
            'name' => 'GitHub',
            'url' => 'https://google.com',
        ]);

        $expected = $resource->id;
        $actual = $paperInstance->resources()->first()->id;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function relationship_paper()
    {
        // Create the paper, date block, and paper instance
        $paper = factory(Paper::class)->create();
        $dateBlock = factory(DateBlock::class)->create();
        $paperInstance = PaperInstance::create(['paper_id' => $paper->id, 'date_block_id' => $dateBlock->id]);

        // Judgement time
        $expected = $paper->id;
        $actual = $paperInstance->paper->id;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function relationship_dateBlock()
    {
        // Create the paper, date block, and paper instance
        $paper = factory(Paper::class)->create();
        $dateBlock = factory(DateBlock::class)->create();
        $paperInstance = PaperInstance::create(['paper_id' => $paper->id, 'date_block_id' => $dateBlock->id]);

        // Judgement time
        $expected = $dateBlock->id;
        $actual = $paperInstance->dateBlock->id;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function relationship_resources()
    {
        $paperInstance = factory(PaperInstance::class)->create();
        $resource = factory(Resource::class)->create(['paper_instance_id' => $paperInstance->id]);

        $expected = $resource->id;
        $actual = $paperInstance->resources()->first()->id;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function relationship_groups()
    {
        $paperInstance = factory(PaperInstance::class)->create();
        $group = factory(Group::class)->create(['paper_instance_id' => $paperInstance->id]);

        $expected = $group->id;
        $actual = $paperInstance->groups()->first()->id;

        $this->assertEquals($expected, $actual);
    }
    /**
     * @test
     */
    public function relationship_lecturersGroup()
    {
        $paperInstance = factory(PaperInstance::class)->create();
        $group = factory(Group::class)->create(['paper_instance_id' => $paperInstance->id]);
        $paperInstance->lecturer_group_id = $group->id;
        $paperInstance->save();

        $expected = $group->id;
        $actual = $paperInstance->lecturersGroup->id;

        $this->assertEquals($expected, $actual);
    }
}
