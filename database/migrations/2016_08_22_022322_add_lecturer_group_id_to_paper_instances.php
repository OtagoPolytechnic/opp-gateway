<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLecturerGroupIdToPaperInstances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paper_instances', function (Blueprint $table) {
            $table->integer('lecturer_group_id')->unsigned();

            $table->foreign('lecturer_group_id')
                  ->references('id')->on('groups')
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
        Schema::table('paper_instances', function (Blueprint $table) {
            $table->dropForeign(['lecturer_group_id']);
            $table->dropColumn('lecturer_group_id');
        });
    }
}
