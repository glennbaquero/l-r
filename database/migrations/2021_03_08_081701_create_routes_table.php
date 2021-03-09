<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->string('report_alias');
            $table->bigInteger('departure_id')->unsigned()->index();
            $table->foreign('departure_id')->references('id')->on('cities')->onDelete('cascade');
            $table->string('type_of_route')->default('Carga');
            $table->time('trip_length');
            $table->time('wait_time');
            $table->bigInteger('distance');
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
        Schema::dropIfExists('routes');
    }
}
