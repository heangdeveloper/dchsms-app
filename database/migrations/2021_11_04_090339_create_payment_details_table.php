<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_details', function (Blueprint $table) {
            $table->id();
            $table->integer('id_invoice');
            $table->integer('id_payment');
            $table->integer('id_inovice_type');
            $table->integer('id_pro_service');
            $table->integer('id_payterm');
            $table->integer('user_id_pay');
            $table->text('description');
            $table->integer('qty');
            $table->float('ori_price');
            $table->integer('disccount');
            $table->float('total_amount');
            $table->float('total_payment');
            $table->date('Volidty_of_payment');
            $table->date('expired_date');
            $table->float('lose_piad');
            $table->integer('school_year');
            $table->text('remark');
            $table->integer('branch_id');
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
        Schema::dropIfExists('payment_details');
    }
}
