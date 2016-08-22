<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaperInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper_instances', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('paper_id')->unsigned();
            $table->integer('date_block_id')->unsigned();

            $table->timestamps();

            $table->foreign('paper_id')
                  ->references('id')->on('papers')
                  ->onDelete('cascade');

            $table->foreign('date_block_id')
                  ->references('id')->on('date_blocks')
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
        Schema::drop('paper_instances');
    }
}
