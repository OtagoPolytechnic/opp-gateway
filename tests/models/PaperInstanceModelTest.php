<?php

use App\DateBlock;
use App\Paper;
use App\PaperInstance;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PaperInstanceModelTest extends TestCase
{
    /**
     * @test
     */
    public function addStudent()
    {
        // Create the paper, date block, and paper instance
        $paper = factory(Paper::class)->create();
        $dateBlock = factory(DateBlock::class)->create();
        $paperInstance = PaperInstance::create(['paper_id' => $paper->id, 'date_block_id' => $dateBlock->id]);

        // Create the student
        $student = factory(User::class)->create();

        // Add the student
        $paperInstance->addStudent($student);

        // Judgement time
        $expected = $student->id;
        $actual = $paperInstance->students()->first()->id;

        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function removeStudent()
    {
        // Create the paper, date block, and paper instance
        $paper = factory(Paper::class)->create();
        $dateBlock = factory(DateBlock::class)->create();
        $paperInstance = PaperInstance::create(['paper_id' => $paper->id, 'date_block_id' => $dateBlock->id]);

        // Create the student
        $student = factory(User::class)->create();

        // Add the student
        $paperInstance->addStudent($student);
        $paperInstance->removeStudent($student);

        // Judgement time
        $expected = 0;
        $actual = $paperInstance->students()->count();

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function addLecturer()
    {
        // Create the paper, date block, and paper instance
        $paper = factory(Paper::class)->create();
        $dateBlock = factory(DateBlock::class)->create();
        $paperInstance = PaperInstance::create(['paper_id' => $paper->id, 'date_block_id' => $dateBlock->id]);

        // Create the lecturer
        $lecturer = factory(User::class)->create();

        // Add the lecturer
        $paperInstance->addLecturer($lecturer);

        // Judgement time
        $expected = $lecturer->id;
        $actual = $paperInstance->lecturers()->first()->id;

        $this->assertEquals($expected, $actual);
    }
    
    /**
     * @test
     */
    public function removeLecturer()
    {
        // Create the paper, date block, and paper instance
        $paper = factory(Paper::class)->create();
        $dateBlock = factory(DateBlock::class)->create();
        $paperInstance = PaperInstance::create(['paper_id' => $paper->id, 'date_block_id' => $dateBlock->id]);

        // Create the lecturer
        $lecturer = factory(User::class)->create();

        // Add the lecturer
        $paperInstance->addLecturer($lecturer);
        $paperInstance->removeLecturer($lecturer);

        // Judgement time
        $expected = 0;
        $actual = $paperInstance->lecturers()->count();

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
    public function relationship_students()
    {
        // Create the paper, date block, and paper instance
        $paper = factory(Paper::class)->create();
        $dateBlock = factory(DateBlock::class)->create();
        $paperInstance = PaperInstance::create(['paper_id' => $paper->id, 'date_block_id' => $dateBlock->id]);

        // Create and attach a student
        $student = factory(User::class)->

        // Judgement time
        $expected = $student->id;
        $actual = $paperInstance->students()->first()->id;

        $this->assertEquals($expected, $actual);
    }
}
