<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('transaction_id')->unsigned()->nullable();
            $table->string('code',36);
            $table->timestamps();
        });
        Schema::create('schedule_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_id')->unsigned();
            $table->string('name');
//            $table->string('description');
            $table->string('locale', 10)->index();

            $table->unique(['schedule_id','locale']);
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_translations');
        Schema::dropIfExists('schedules');
    }
}
