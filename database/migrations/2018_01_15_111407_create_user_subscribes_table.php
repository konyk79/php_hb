<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_subscribes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('payment_system_id')->unsigned();
            $table->string('payment_system_refid',150)->nullable()->unique();
            $table->integer('status_id')->unsigned();
            $table->integer('subscribe_id')->unsigned();
            $table->integer('promo_id')->unsigned()->nullable();
            $table->float('price');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_terminated')->default(true);
            $table->boolean('is_confirmed')->default(false);
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
        Schema::dropIfExists('user_has_subscribes');
    }
}
