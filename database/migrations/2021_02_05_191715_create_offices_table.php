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
            $table->string('office_no');
            $table->string('phone_number');
            $table->string('ledger_transaction')->nullable();

            $table->bigInteger('office_type_id')->unsigned()->nullable();
            $table->foreign('office_type_id')->references('id')->on('office_types')->onDelete('cascade');

            $table->bigInteger('terminal_id')->unsigned()->nullable();
            $table->foreign('terminal_id')->references('id')->on('terminals')->onDelete('cascade');

            $table->bigInteger('departure_city_id')->unsigned()->nullable();
            $table->foreign('departure_city_id')->references('id')->on('cities')->onDelete('cascade');
            
            $table->bigInteger('arrival_city_id')->unsigned()->nullable();
            $table->foreign('arrival_city_id')->references('id')->on('cities')->onDelete('cascade');
            
            $table->boolean('main_stop_office')->default(false);
            $table->boolean('boarding_landing')->default(false);
            $table->boolean('pre_printed_voucher')->default(false);

            $table->boolean('shipping_office')->default(false);

            $table->string('ticket_sold_color')->nullable();
            
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('state_name')->nullable();
            $table->string('zip')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

            $table->boolean('status')->default(true);

            $table->boolean('collect_commission_only')->default(false);
            $table->boolean('pays_net_amount')->default(false);
            $table->string('commission_type')->default('P');
            $table->decimal('commission', 9, 2)->nullable();
            $table->boolean('hide_price')->default(false);
            $table->boolean('print_to_capture')->default(false);
            $table->boolean('sell_remote_tickets')->default(false);
            $table->string('main_agency')->nullable();
            $table->bigInteger('main_terminal_id')->unsigned()->nullable();
            $table->foreign('main_terminal_id')->references('id')->on('terminals')->onDelete('cascade');
            $table->string('using_van')->nullable();

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
        Schema::dropIfExists('offices');
    }
}
