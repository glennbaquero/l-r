<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bus_model_id')->unsigned()->index();
            $table->string('name');
            $table->string('plate');
            $table->string('transport_type')->default('Tickets');
            $table->string('certificate')->nullable();
            $table->string('configuration_vehicular')->nullable();
            $table->string('brand')->nullable();
            $table->boolean('first_floor_to_show')->default(true);
            $table->boolean('default_bus')->default(false);
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
        Schema::dropIfExists('buses');
    }
}
