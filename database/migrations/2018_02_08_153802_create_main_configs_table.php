<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_subscribe_timeout');
            $table->string('lesson_cancel_timeout');
            $table->string('lesson_before_start_timeout');
            $table->string('lesson_after_start_timeout');
            $table->string('slider_timeout');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_configs');
    }
}
