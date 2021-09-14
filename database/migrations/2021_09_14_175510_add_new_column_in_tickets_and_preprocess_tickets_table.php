<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnInTicketsAndPreprocessTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->bigInteger('trip_time_id')->unsigned()->nullable();
            $table->foreign('trip_time_id')->references('id')->on('trip_times')->onDelete('cascade');
            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
        
        Schema::table('preprocess_tickets', function (Blueprint $table) {
            $table->bigInteger('trip_time_id')->unsigned()->nullable();
            $table->foreign('trip_time_id')->references('id')->on('trip_times')->onDelete('cascade');
            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            //
        });
    }
}
