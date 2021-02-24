<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GroupsGroupPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_group_privilege', function (Blueprint $table) {
            $table->integer('group_id');
            $table->integer('group_privilege_id');
            $table->boolean('selected')->default(false);
            $table->primary(['group_id', 'group_privilege_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
