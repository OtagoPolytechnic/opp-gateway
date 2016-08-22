<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_role', function (Blueprint $table) {
            $table->integer('group_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->timestamps();

            $table->primary(['group_id', 'role_id']);
            
            $table->foreign('group_id')
                  ->references('id')->on('groups')
                  ->onDelete('cascade');

            $table->foreign('role_id')
                  ->references('id')->on('roles')
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
        Schema::drop('group_role');
    }
}
