<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('phone_number');

            $table->bigInteger('office_type_id')->unsigned()->nullable();
            $table->foreign('office_type_id')->references('id')->on('office_types')->onDelete('cascade');

            $table->bigInteger('terminal_id')->unsigned()->nullable();
            $table->foreign('terminal_id')->references('id')->on('terminals')->onDelete('cascade');
            
            $table->boolean('main_stop_office')->default(false);
            $table->boolean('boarding_landing')->default(false);
            $table->boolean('pre_printed_voucher')->default(false);
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
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
        Schema::dropIfExists('offices');
    }
}
