<?php

use App\Calendar;
use App\User;

use Illuminate\Database\Seeder;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear the calendars table
        Calendar::truncate();
        
        // Get the users
        $user1 = App\User::FindOrFail(1);
        $user2 = App\User::FindOrFail(2);
        $user3 = App\User::FindOrFail(3);
        
        // Create some calendars some with with subscribers
        $calendar1 = Calendar::create(['owner_id' => $user1->id, 'name' => 'Calendar One', 'colour' => '7e9949']);

        $calendar2 = Calendar::create(['owner_id' => $user1->id, 'name' => 'Calendar Two', 'colour' => '3E78B2']);
        $calendar2->subscribers()->attach($user2);
        $calendar2->subscribers()->attach($user3);

        $calendar3 = Calendar::create(['owner_id' => $user1->id, 'name' => 'Calendar Three', 'colour' => 'C03221']);
        $calendar3->subscribers()->attach($user2);

        $calendar4 = Calendar::create(['owner_id' => $user2->id, 'name' => 'Calendar for User 2', 'colour' => 'E3B505']);
        $calendar4->subscribers()->attach($user1);
    }
}
