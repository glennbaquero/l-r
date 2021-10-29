<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('passenger_id')->unsigned()->index();
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('cascade');
            $table->bigInteger('seller_id')->unsigned()->index();
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('arrival_id')->unsigned()->index();
            $table->foreign('arrival_id')->references('id')->on('cities')->onDelete('cascade');
            $table->bigInteger('departure_id')->unsigned()->index();
            $table->foreign('departure_id')->references('id')->on('cities')->onDelete('cascade');
            $table->bigInteger('trip_id')->unsigned()->index();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->bigInteger('bus_model_column_id')->unsigned()->index();
            $table->foreign('bus_model_column_id')->references('id')->on('bus_model_columns')->onDelete('cascade');
            $table->integer('number_of_ticket')->nullable();
            $table->string('reservation_code')->nullable();
            $table->datetime('reservation_date')->nullable();
            $table->datetime('purchase_date');
            $table->string('voucher_code')->nullable();
            $table->string('payment_method')->default('Cash');
            $table->decimal('total_sale', 9, 2)->default(0);
            $table->string('boarding_status')->default('Not Boarded');
            $table->string('payment_status')->default('Reserved');
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
        Schema::dropIfExists('tickets');
    }
}
