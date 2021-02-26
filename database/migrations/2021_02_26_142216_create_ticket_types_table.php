<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('document_type_id')->unsigned()->nullable();
            $table->foreign('document_type_id')->references('id')->on('document_types')->onDelete('cascade');
            $table->boolean('available_sale_web')->default(false);
            $table->boolean('available_to_coupon')->default(false);
            $table->string('discount_type')->default('Decimal');
            $table->decimal('discount')->default(0);
            $table->boolean('return_discount')->default(false);
            $table->boolean('required_authorization')->default(false);
            $table->boolean('required_email')->default(false);
            $table->boolean('required_telephone')->default(false);
            $table->text('message')->nullable();
            $table->boolean('show_message')->default(false);
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('edited_by')->unsigned()->nullable();
            $table->foreign('edited_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('ticket_types');
    }
}
