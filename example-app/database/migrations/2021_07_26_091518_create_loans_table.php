<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('loan_plan_id')->unsigned();
            $table->integer('interest_rate')->unsigned()->nullable();
            $table->integer('penalty_rate')->unsigned()->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->double('arrangement_fee', 11, 0)->nullable();
            $table->double('paid_amount', 11, 0)->nullable();
            $table->double('remain_amount', 11, 0)->nullable();
            $table->double('total_amount', 11, 0)->nullable();
            $table->double('daily_amount', 11, 0)->nullable();
            $table->double('penalty_amount', 11, 0)->nullable();
            $table->double('origin_amount', 11, 0)->nullable();
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
        Schema::dropIfExists('loans');
    }
}

