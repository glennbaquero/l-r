<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('passenger_id')->unsigned()->index();
            $table->foreign('passenger_id')->references('id')->on('passengers')->onDelete('cascade');
            $table->string('type_of_voucher')->default('Amount');
            $table->string('code');
            $table->decimal('amount', 9, 2)->default(0);
            $table->decimal('amount_used', 9, 2)->default(0);
            $table->decimal('max_no_of_ticket_courtesy', 9, 2)->default(0);
            $table->decimal('no_of_ticket_courtesy_used', 9, 2)->default(0);
            $table->decimal('discount_percent', 9, 2)->default(0);
            $table->decimal('max_no_of_discount_ticket', 9, 2)->default(0);
            $table->decimal('no_of_discount_ticket_used', 9, 2)->default(0);
            $table->date('expiration_date');
            $table->string('authorized_by');
            $table->text('description')->nullable();
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
        Schema::dropIfExists('vouchers');
    }
}
