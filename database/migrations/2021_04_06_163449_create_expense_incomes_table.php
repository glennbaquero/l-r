<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_incomes', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('Income');
            $table->bigInteger('authorized_by')->unsigned()->index();
            $table->foreign('authorized_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('created_by')->unsigned()->index();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('trip_id')->unsigned()->nullable();
            $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            $table->string('income_expense_type');
            $table->text('concept');
            $table->decimal('amount',9 ,2)->default(0);
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
        Schema::dropIfExists('expense_incomes');
    }
}
