<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->bigInteger('printer_brand_id')->unsigned()->nullable();
            $table->foreign('printer_brand_id')->references('id')->on('printer_brands')->onDelete('cascade');
            $table->bigInteger('printer_model_id')->unsigned()->nullable();
            $table->foreign('printer_model_id')->references('id')->on('printer_models')->onDelete('cascade');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('printers');
    }
}
