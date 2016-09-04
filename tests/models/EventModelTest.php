<?php

use App\Calendar;
use App\Event;
use App\User;

class EventModelTest extends TestCase
{
    /**
     * @test
     */
    public function relationship_calendar()
    {
        // Create the Calendar and Event
        $calendarOwner = factory(User::class)->create();
        $calendar = factory(Calendar::class)->create(['owner_id' => $calendarOwner->id]);
        $event = factory(Event::class)->create(['calendar_id' => $calendar->id]);

        $expected = true;
        $actual = $calendar->events->contains($event);

        $this->assertEquals($expected, $actual);
    }
}
