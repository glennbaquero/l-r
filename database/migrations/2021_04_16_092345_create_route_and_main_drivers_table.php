<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteAndMainDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_and_main_drivers', function (Blueprint $table) {
            $table->id();

            $table->string('type')->default('Ticket of Route');

            $table->string('type_of_record')->default('all');
            $table->string('series');
            $table->string('correlative');
            $table->date('issued_date');
            $table->text('description')->nullable();
            $table->string('state');
            $table->decimal('price', 9, 2)->default(0);
            $table->string('code_reference')->nullable();
            
            // Ticket of Route
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('driver')->nullable();

            $table->bigInteger('departure_id')->unsigned()->nullable();
            $table->foreign('departure_id')->references('id')->on('cities')->onDelete('cascade');
            $table->bigInteger('arrival_id')->unsigned()->nullable();
            $table->foreign('arrival_id')->references('id')->on('cities')->onDelete('cascade');
            $table->bigInteger('driver_id')->unsigned()->nullable();
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');

            $table->date('travel_date')->nullable();
            $table->time('time')->nullable();
            $table->string('seat')->nullable();

            // Voucher Of Route
            $table->string('voucher_type')->nullable();

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
        Schema::dropIfExists('route_and_main_drivers');
    }
}
