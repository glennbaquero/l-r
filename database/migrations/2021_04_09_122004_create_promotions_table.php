<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('Amount');
            $table->decimal('value', 9, 2)->default(0);
            $table->decimal('point_equivalent', 9, 2)->default(0);
            $table->string('filter_by')->default('Day');
            $table->date('date');
            $table->date('end_date')->nullable();
            $table->string('apply_to')->default('all_routes');
            $table->string('tickets')->default('all');
            $table->string('filter_day')->default('All');
            $table->text('days')->nullable();
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
        Schema::dropIfExists('promotions');
    }
}
