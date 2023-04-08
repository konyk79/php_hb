<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSystemNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_system_notifications', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('payment_processor_id')->unsigned();

            $table->integer('payment_system_id')->unsigned();
            $table->foreign('payment_system_id')->references('id')->on('payment_systems')->onDelete('cascade');

            $table->string('message_id');
            $table->text('message_body');
            $table->boolean('is_processed')->default(false);

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
        Schema::dropIfExists('payment_system_notifications');
    }
}
