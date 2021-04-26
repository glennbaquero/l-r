<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('promotion_apply_to')->default('All');
            $table->string('change_type')->default('Discount');
            $table->string('option')->nullable();

            $table->boolean('open_ticket_applies')->boolean(false);

            $table->string('max_per_bus')->default('Unlimited');
            $table->bigInteger('max_per_bus_value')->default(0);

            $table->string('filter_by')->default('Day');
            $table->date('date');
            $table->date('end_date')->nullable();
            $table->string('filter_day')->default('All');
            $table->text('days')->nullable();

            $table->string('apply_to')->default('all_routes');

            $table->string('type')->nullable();
            $table->decimal('amount', 9, 2)->default(0);
            $table->boolean('apply_volume_discount')->default(false);

            $table->text('trip_type'); //array

            $table->boolean('apply_ticket_type')->default(false);
            $table->boolean('apply_multiroute')->default(false);
            $table->boolean('presales_day')->default(false);
            $table->string('presales_days')->nullable();

            $table->string('partnership')->default('all');
           
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
        Schema::dropIfExists('discounts');
    }
}
