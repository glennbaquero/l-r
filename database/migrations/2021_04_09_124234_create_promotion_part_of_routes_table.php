<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionPartOfRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_part_of_routes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('promotion_id')->unsigned()->index();
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
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
        Schema::dropIfExists('promotion_part_of_routes');
    }
}
