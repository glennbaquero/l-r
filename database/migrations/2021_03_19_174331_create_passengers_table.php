<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('trip_id')->unsigned()->nullable();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->bigInteger('bus_model_column_id')->unsigned()->nullable();
            $table->foreign('bus_model_column_id')->references('id')->on('bus_model_columns')->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name');
            $table->bigInteger('arrival_city_id')->unsigned()->index();
            $table->foreign('arrival_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('state')->nullable();
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
        Schema::dropIfExists('passengers');
    }
}
