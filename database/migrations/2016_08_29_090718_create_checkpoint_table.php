<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckpointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkpoints', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->decimal('weight',10,2);
            $table->date('date');

            $table->integer('gradebook_id')->unsigned;

            $table->foreign('gradebook_id')
                  ->references('id')->on('gradebooks')
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
        Schema::drop('checkpoints');
    }
}