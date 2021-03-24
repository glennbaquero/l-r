<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaggageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baggage', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ticket_id')->unsigned()->index();
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->string('series')->nullable();
            $table->string('alias')->nullable();
            $table->string('correlative')->nullable();
            $table->decimal('total_weight', 9, 2)->default(0);
            $table->decimal('total_amount', 9, 2)->default(0);
            $table->decimal('received_amount', 9, 2)->default(0);
            $table->decimal('return_cash', 9, 2)->default(0);
            $table->date('payment_date');
            $table->string('payment_form')->default('Cash');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->datetime('record_date');
            $table->string('state')->default('Register');
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
        Schema::dropIfExists('baggage');
    }
}
