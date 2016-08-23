<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeLecturerGroupIdForeignKeyNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paper_instances', function (Blueprint $table) {
            $table->integer('lecturer_group_id')->unsigned()->nullable()->change();
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
            // We are making a change to a foreign key, so we need to disable constraints temporarily
            Schema::enableForeignKeyConstraints();

            $table->integer('lecturer_group_id')->unsigned()->nullable(false)->change();

            Schema::disableForeignKeyConstraints();
        });
    }
}
