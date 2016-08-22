<?php

use App\Paper;
use App\Resource;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResourceModelTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * @test
     */
    public function relationship_paper()
    {
        $paper = factory(Paper::class)->create();
        $resource = factory(Resource::class)->create(['paper_id' => $paper->id]);

        $expected = $paper->id;
        $actual = $resource->paper->id;

        $this->assertEquals($expected, $actual);
    }
}
