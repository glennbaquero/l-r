<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationTerminalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration_terminals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('office_id')->unsigned()->nullable();
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
            $table->string('operating_system');
            $table->string('web_browser');
            $table->bigInteger('printer_brand_id')->unsigned()->nullable();
            $table->foreign('printer_brand_id')->references('id')->on('printer_brands')->onDelete('cascade');
            $table->bigInteger('printer_id')->unsigned()->nullable();
            $table->foreign('printer_id')->references('id')->on('printers')->onDelete('cascade');
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
        Schema::dropIfExists('configuration_terminals');
    }
}
