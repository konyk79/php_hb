<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSubStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_sub_statuses', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('transaction_id')->unsigned()->nullable();
            $table->string('code',36);
            $table->timestamps();
        });
        Schema::create('user_sub_status_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_sub_status_id')->unsigned();
            $table->string('name');
//            $table->string('description');
            $table->string('locale', 10)->index();

            $table->unique(['user_sub_status_id','locale']);
            $table->foreign('user_sub_status_id')->references('id')->on('user_sub_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_sub_status_translations');
        Schema::dropIfExists('user_sub_statuses');
    }
}
