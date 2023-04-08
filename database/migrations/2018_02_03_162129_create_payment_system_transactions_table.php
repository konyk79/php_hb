<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSystemTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_system_transactions', function (Blueprint $table) {
            $table->increments('id');

            $table->string('sum');
            $table->string('currency');

            $table->integer('notification_id')->unsigned();
            $table->foreign('notification_id')->references('id')->on('payment_system_notifications')->onDelete('cascade');


            $table->integer('subscribe_id')->unsigned();
            $table->foreign('subscribe_id')->references('id')->on('user_has_subscribes')->onDelete('cascade');

            $table->integer('payment_system_id')->unsigned();
            $table->foreign('payment_system_id')->references('id')->on('payment_systems')->onDelete('cascade');

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
        Schema::dropIfExists('payment_system_transactions');
    }
}
