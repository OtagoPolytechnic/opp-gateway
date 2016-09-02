<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Faker\Generator;
use Carbon\Carbon;

$factory->define(App\User::class, function (Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Paper::class, function (Generator $faker) {
    $name = $faker->words($faker->numberBetween(1, 4), true);
    $code = 'IN' . $faker->numberBetween(500, 800);

    return [
        'name' => $name,
        'code' => $code,
    ];
});

// The user will need to set the paper_id themselves
$factory->define(App\Resource::class, function (Generator $faker) {
    $name = $faker->words($faker->numberBetween(1, 4), true);
    $url = $faker->url;

    return [
        'name' => $name,
        'url' => $url,
    ];
});

$factory->define(App\DateBlock::class, function (Generator $faker) {
    $name = $faker->words($faker->numberBetween(1, 4), true);
    $startDate = Carbon::createFromTimeStamp($faker->dateTimeBetween('-30 days', '+30 days')->getTimestamp());
    $maxDate = $startDate->copy()->addYear();
    $endDate = $faker->dateTimeBetween($startDate, $maxDate);

    return [
        'name' => $name,
        'start_date' => $startDate,
        'end_date' => $endDate,
    ];
});

$factory->define(App\PaperInstance::class, function (Generator $faker) {
    $paper = factory(App\Paper::class)->create();
    $dateBlock = factory(App\DateBlock::class)->create();

    return [
        'paper_id' => $paper->id,
        'date_block_id' => $dateBlock->id,
    ];
});

$factory->define(App\Group::class, function (Generator $faker) {
    $paperInstance = factory(App\PaperInstance::class)->create();
    $name = $faker->words($faker->numberBetween(1, 4), true);

    return [
        'paper_instance_id' => $paperInstance->id,
        'name' => $name,
        'hidden' => false,
    ];
});

$factory->define(App\Role::class, function (Generator $faker) {
    $name = $faker->words($faker->numberBetween(1, 4), true);

    return [
        'name' => $name,
    ];
});

$factory->define(App\Calendar::class, function (Generator $faker) {
    $startDate = Carbon::createFromTimeStamp($faker->dateTimeBetween('-30 days', '+30 days')->getTimestamp());

    return [
        'name' => $faker->words(2, true),
    ];
});

$factory->define(App\Event::class, function (Generator $faker) {
    $startDate = Carbon::createFromTimeStamp($faker->dateTimeBetween('-30 days', '+30 days')->getTimestamp());

    return [
        'start_time' => $startTime,
        'duration' => rand(1, 10) * 15,
        'place' => 'D' . rand(1, 3) . rand(1, 15),
        'repeat_mode' => REPEAT_MODE_NO_REPEAT,
        'last_day_of_repetition' => $startDate,
        'repetition_id' => rand(100),
    ];
});
