<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('promotion_name');
            $table->string('promotion_alias');
            $table->string('applies_to')->default('All');
            $table->string('coupon_type');
            $table->decimal('value', 9, 2);
            $table->bigInteger('number_of_coupons')->default(0);
            $table->bigInteger('coupon_used')->default(0);
            $table->bigInteger('coupon_available')->default(0);
            $table->decimal('max_purchase_per_client', 9, 2)->default(0);
            $table->decimal('max_per_bus', 9, 2)->default(0);
            $table->string('filter_by_date')->default('Travel');
            $table->string('trip_filter')->default('Day');
            $table->date('trip_date')->nullable();
            $table->date('trip_end_date')->nullable();
            $table->string('trip_filter_day')->default('All');
            $table->text('trip_days')->nullable(); //array

            $table->string('purchase_date_filter')->default('Day');
            $table->date('purchase_date')->nullable();
            $table->date('purchase_end_date')->nullable();
            $table->string('purchase_date_filter_day')->default('All');
            $table->text('purchase_date_days')->nullable(); //array

            $table->string('apply_to')->default('all_routes');
            $table->text('trip_type')->nullable(); //array
            $table->text('base_fare')->nullable(); //array

            $table->boolean('apply_minimum_price')->default(false);
            $table->decimal('minimum_price_value', 9, 2)->default(0);
            $table->bigInteger('authorized_by')->unsigned()->index();
            $table->foreign('authorized_by')->references('id')->on('users')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->boolean('daily_restart')->default(false);
            $table->boolean('apply_multiroute')->default(false);
            $table->boolean('apply_by_section')->default(false);
            
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
        Schema::dropIfExists('coupons');
    }
}
