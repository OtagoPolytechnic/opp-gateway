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

        // We expect the event to exist in the calendar... Let's see if we're right
        $calendarContainsEvent = $calendar->events->contains($event);
        $this->assertTrue($calendarContainsEvent);
    }
}
