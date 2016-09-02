<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('calendar_id')->unsigned();

            // Event details...
            $table->dateTime('start_time');
            $table->integer('duration'); // In minutes
            $table->string('place');

            // Repeating events...
            $table->integer('repeat_mode')->default(REPEAT_MODE_NO_REPEAT);
            $table->date('last_day_of_repetition');
            $table->integer('repetition_id'); // So we can find which events are part of a single repeating event. This will be the id of the first event (doesn't matter if that event is deleted)

            $table->timestamps();

            $table->foreign('calendar_id')
                  ->references('id')->on('calendars')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
