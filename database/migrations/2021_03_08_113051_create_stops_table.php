<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stops', function (Blueprint $table) {
            $table->id();
            $table->time('trip_length');
            $table->time('wait_time');
            $table->bigInteger('distance');
            $table->bigInteger('route_id')->unsigned()->index();
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->bigInteger('arrival_id')->unsigned()->index();
            $table->foreign('arrival_id')->references('id')->on('cities')->onDelete('cascade');
            $table->bigInteger('departure_id')->unsigned()->index();
            $table->foreign('departure_id')->references('id')->on('cities')->onDelete('cascade');
            $table->boolean('division_point')->default(false);
            $table->boolean('show')->default(true);
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
        Schema::dropIfExists('stops');
    }
}
