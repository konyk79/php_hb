<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSystemConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('payment_system_configs', function($table) {
            /** @var \Illuminate\Database\Schema\Blueprint $table */
            $table->bigIncrements('id');
            $table->text('config');
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
        Schema::dropIfExists('payment_system_configs');
    }
}
