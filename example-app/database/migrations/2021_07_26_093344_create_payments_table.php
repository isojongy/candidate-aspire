<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no', 12)->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('loan_id')->unsigned();
            $table->string('content', 500);
            $table->double('amount', 11, 0);
            $table->double('paid_amount', 11, 0)->nullable();
            $table->double('remain_amount', 11, 0)->nullable();
            $table->double('total_amount', 11, 0)->nullable();
            $table->double('penalty_fee', 11, 0)->nullable();
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
        Schema::dropIfExists('payments');
    }
}
