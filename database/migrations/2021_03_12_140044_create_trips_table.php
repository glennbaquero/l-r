<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('route_id')->unsigned()->index();
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->bigInteger('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->string('alias_route');
            $table->date('date');
            $table->time('time');
            $table->bigInteger('service_id')->unsigned()->index();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->string('transport_type')->default('Tickets');
            $table->bigInteger('bus_id')->unsigned()->index();
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('cascade');
            $table->bigInteger('driver_id')->unsigned()->index();
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->bigInteger('main_co_driver_id')->unsigned()->nullable();
            $table->foreign('main_co_driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->bigInteger('secondary_co_driver_id')->unsigned()->nullable();
            $table->foreign('secondary_co_driver_id')->references('id')->on('drivers')->onDelete('cascade');

            $table->bigInteger('crew_id')->unsigned()->nullable();
            // $table->foreign('crew_id')->references('id')->on('crews')->onDelete('cascade');

            $table->bigInteger('assistant_id')->unsigned()->nullable();
            // $table->foreign('assistant_id')->references('id')->on('assistants')->onDelete('cascade');

            $table->boolean('discounted_tickets')->default(false);
            $table->boolean('show_on_web')->default(false);
            $table->boolean('additional_receipt')->default(false);
            $table->boolean('express_trip')->default(false);

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
        Schema::dropIfExists('trips');
    }
}

