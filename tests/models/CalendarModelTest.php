<?php

use App\Calendar;
use App\Event;
use App\User;

class CalendarModelTest extends TestCase
{
    /**
     * @test
     */
    public function relationship_owner()
    {
        // Create the Calendar and Owner
        $calendarOwner = factory(User::class)->create();
        $calendar = factory(Calendar::class)->create(['owner_id' => $calendarOwner->id]);

        // Check the user we created is the owner of the calendar we created
        $expected = $calendarOwner->id;
        $actual = $calendar->owner->id;

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     */
    public function relationship_subscribers()
    {
        // Create the Calendar and Owner
        $calendarOwner = factory(User::class)->create();
        $calendar = factory(Calendar::class)->create(['owner_id' => $calendarOwner->id]);

        // Create and add the subscriber
        $calendarSubscriber = factory(App\User::class)->create();
        $calendar->subscribers()->attach($calendarSubscriber);

        // We expect the calendar subscribers to include the new subscriber we added... Let's see if we're right
        $calendarHasSubscriber = $calendar->subscribers->contains($calendarSubscriber);
        $this->assertTrue($calendarHasSubscriber);
    }

    /**
     * @test
     */
    public function relationship_events()
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
