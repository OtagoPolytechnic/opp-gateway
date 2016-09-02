<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarSubscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_subscriber', function (Blueprint $table) {
            $table->integer('calendar_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->timestamps();

            $table->primary(['calendar_id', 'user_id']);
            
            $table->foreign('calendar_id')
                  ->references('id')->on('calendars')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')->on('users')
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
        Schema::drop('calendar_subscriber');
    }
}
