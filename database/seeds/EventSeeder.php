<?php

use App\Calendar;
use App\Event;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the calendars table
        Event::truncate();

        // Define the number of events for each calendar
        $nEventsPerCalendar = 10;

        // Get all the calendars
        $calendars = Calendar::get();
        
        foreach ($calendars as $calendar) {
            foreach (range(1, $nEventsPerCalendar + 1) as $eventNumber) {
                $startTime = $this->randomDateTime('-20 days', '+20 days');

                // Create the event
                Event::create([
                    'name' => 'Event ' . $eventNumber,
                    'calendar_id' => $calendar->id,
                    'start_time' => $startTime,
                    'duration' => rand(1, 10) * 15,
                    'place' => 'D' . rand(1, 3) . rand(1, 15),
                ]);
            }
        }
    }

    function randomDateTime($startTime, $endTime)
    {
        // Convert to timestamps
        $min = strtotime($startTime);
        $max = strtotime($endTime);

        // Generate random number using above min and max
        $randomTimestamp = mt_rand($min, $max);

        // Convert back to desired date format
        return  Carbon::createFromTimestamp($randomTimestamp);
    }
}
