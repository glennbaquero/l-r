<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreprocessTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preprocess_tickets', function (Blueprint $table) {
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
            $table->boolean('is_cancelled')->default(false);
            $table->bigInteger('new_seat_id')->unsigned()->nullable();
            $table->foreign('new_seat_id')->references('id')->on('bus_model_columns')->onDelete('cascade');
            $table->boolean('is_registered_payment')->default(false);
            $table->bigInteger('office_id')->unsigned()->index();
            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');

            $table->boolean('confirmed')->default(false);
            $table->datetime('confirmation_date')->nullable();
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
        Schema::dropIfExists('preprocess_tickets');
    }
}
