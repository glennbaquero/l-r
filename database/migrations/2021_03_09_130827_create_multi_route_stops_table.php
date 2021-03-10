<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiRouteStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_route_stops', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('departure_id')->unsigned()->index();
            $table->foreign('departure_id')->references('id')->on('cities')->onDelete('cascade');
            $table->bigInteger('arrival_id')->unsigned()->index();
            $table->foreign('arrival_id')->references('id')->on('cities')->onDelete('cascade');
            $table->bigInteger('multi_route_id')->unsigned()->index();
            $table->foreign('multi_route_id')->references('id')->on('multi_routes')->onDelete('cascade');
            $table->bigInteger('route_id')->unsigned()->index();
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->boolean('auto')->default(false);
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
        Schema::dropIfExists('multi_route_stops');
    }
}
