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
            $table->string('middle_name')->nullable();
            $table->bigInteger('arrival_city_id')->unsigned()->index();
            $table->foreign('arrival_city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->bigInteger('ticket_type_id')->unsigned()->nullable();
            $table->foreign('ticket_type_id')->references('id')->on('ticket_types')->onDelete('cascade');
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('cellphone_number')->nullable();
            $table->string('state')->nullable();
            $table->string('gender')->default('Male');
            $table->string('zip_code')->nullable();
            $table->string('referral_source')->nullable();
            $table->boolean('with_infant')->default(false);
            $table->string('infant_firstname')->nullable();
            $table->string('infant_lastname')->nullable();
            $table->string('infant_gender')->default('Male');
            $table->bigInteger('no_of_bags')->default(0);
            $table->bigInteger('luggage_no')->default(0);
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
