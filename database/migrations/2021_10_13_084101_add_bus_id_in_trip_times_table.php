<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusIdInTripTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->bigInteger('bus_id')->unsigned()->nullable()->change();
        });

        Schema::table('trip_times', function (Blueprint $table) {
            $table->bigInteger('bus_id')->unsigned()->nullable()->after('driver_id');
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->bigInteger('driver_id')->unsigned()->nullable()->change();

            $table->time('arrival_time')->nullable()->after('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trip_times', function (Blueprint $table) {
            //
        });
    }
}
