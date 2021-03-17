<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusModelColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_model_columns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bus_model_row_id')->unsigned()->index();
            $table->string('image_path')->nullable();
            $table->string('label')->nullable();
            $table->integer('orientation')->default(360);
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
        Schema::dropIfExists('bus_model_columns');
    }
}
