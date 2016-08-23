<?php

use App\PaperInstance;
use App\Resource;

class ResourceModelTest extends TestCase
{
    /**
     * @test
     */
    public function relationship_paperInstance()
    {
        $paperInstance = factory(PaperInstance::class)->create();
        $resource = factory(Resource::class)->create(['paper_instance_id' => $paperInstance->id]);

        $expected = $paperInstance->id;
        $actual = $resource->paperInstance->id;

        $this->assertEquals($expected, $actual);
    }
}
