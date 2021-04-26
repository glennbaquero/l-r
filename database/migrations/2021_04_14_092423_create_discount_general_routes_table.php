<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountGeneralRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_general_routes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('discount_id')->unsigned()->index();
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');
            $table->bigInteger('departure_id')->unsigned()->nullable();
            $table->foreign('departure_id')->references('id')->on('cities')->onDelete('cascade');
            $table->bigInteger('arrival_id')->unsigned()->nullable();
            $table->foreign('arrival_id')->references('id')->on('cities')->onDelete('cascade');
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
        Schema::dropIfExists('discount_general_routes');
    }
}
