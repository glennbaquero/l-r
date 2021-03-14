<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('staff_type')->default('Driver');
            $table->boolean('by_default')->default(false);
            $table->string('document_type')->default('CDL');
            $table->string('document_no');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('phone_number');
            $table->string('email');
            $table->string('address_line_1');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('city');
            $table->decimal('commission', 9, 2)->default(0);
            $table->string('license_type');
            $table->string('license_no');
            $table->date('license_expiration_date');
            $table->date('last_medical_test_date');
            $table->date('next_medical_test_date');
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
        Schema::dropIfExists('drivers');
    }
}
