<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_systems', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('payment_processor_id')->unsigned();

            $table->timestamps();
        });

        Schema::create('payment_system_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_system_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->string('locale', 10)->index();

            $table->unique(['payment_system_id','locale']);
            $table->foreign('payment_system_id')->references('id')->on('payment_systems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_system_translations');
        Schema::dropIfExists('payment_systems');
    }
}
