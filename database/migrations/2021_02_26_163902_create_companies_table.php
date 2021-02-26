<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('code')->nullabe();
            $table->boolean('company_to_transfer')->default(false);
            $table->boolean('shipment_of_package')->default(false);
            $table->boolean('company_interlines')->default(false);
            $table->decimal('discount', 9, 2)->default(0);
            $table->boolean('contract_company')->default(false);
            $table->boolean('own_company')->default(false);
            $table->boolean('credit_assign')->default(false);

            // if credit assign is true
            $table->string('image_path')->nullable();
            $table->string('type_of_credit_line')->default('Unlimited');
            $table->decimal('max_credit_line', 9, 2)->default(0);
            $table->decimal('max_number_ticket', 9, 2)->default(0);
            $table->boolean('print_bill')->default(false);

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
        Schema::dropIfExists('companies');
    }
}
