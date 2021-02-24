<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('see_message')->default(false);
            $table->boolean('write_post')->default(false);
            $table->boolean('send_post')->default(false);
            $table->boolean('authorized_power')->default(false);
            $table->boolean('can_sell_open')->default(false);
            $table->string('download_report')->nullable();
            $table->boolean('has_commission')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
