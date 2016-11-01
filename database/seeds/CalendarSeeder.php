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
        $calendar1 = Calendar::create(['owner_id' => $user1->id, 'name' => 'My stuff', 'colour' => '428bca']);

        $calendar2 = Calendar::create(['owner_id' => $user1->id, 'name' => 'Work', 'colour' => '5cb85c']);
        $calendar2->subscribers()->attach($user2);
        $calendar2->subscribers()->attach($user3);

        $calendar3 = Calendar::create(['owner_id' => $user1->id, 'name' => 'OOSD', 'colour' => '337ab7']);
        $calendar3->subscribers()->attach($user2);

        $calendar4 = Calendar::create(['owner_id' => $user2->id, 'name' => 'Algorithms & Data Structures', 'colour' => 'd9534f']);
        $calendar4->subscribers()->attach($user1);
    }
}
