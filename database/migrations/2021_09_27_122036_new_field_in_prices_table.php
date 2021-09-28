<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewFieldInPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prices', function (Blueprint $table) {
            $table->decimal('adult_one_way', 9, 2)->default(0);
            $table->decimal('adult_roundtrip', 9, 2)->default(0);
            $table->decimal('senior_one_way', 9, 2)->default(0);
            $table->decimal('senior_roundtrip', 9, 2)->default(0);
            $table->decimal('child_one_way', 9, 2)->default(0);
            $table->decimal('child_roundtrip', 9, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prices', function (Blueprint $table) {
            //
        });
    }
}
