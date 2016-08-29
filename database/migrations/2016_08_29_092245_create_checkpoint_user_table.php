<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckpointUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkpoint_user', function (Blueprint $table) {
            $table->integer('checkpoint_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->timestamps();

            $table->decimal('score',10,2);

            $table->primary(['checkpoint_id','user_id']);

            $table->foreign('checkpoint_id')
                  ->references('id')->on('checkpoints')
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
        Schema::drop('checkpoint_user');
    }
}