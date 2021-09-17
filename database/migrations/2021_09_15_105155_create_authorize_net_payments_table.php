<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorizeNetPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorize_net_payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->decimal('amount', 10, 2);
            $table->string('currency');
            $table->string('payment_status');
            $table->bigInteger('ticket_id')->unsigned()->nullable();
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->bigInteger('preprocess_ticket_id')->unsigned()->nullable();
            $table->foreign('preprocess_ticket_id')->references('id')->on('preprocess_tickets')->onDelete('cascade');
            $table->bigInteger('passenger_id')->unsigned()->nullable();
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('cascade');
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
        Schema::dropIfExists('authorize_net_payments');
    }
}
