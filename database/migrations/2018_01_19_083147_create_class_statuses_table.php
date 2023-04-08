<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_statuses', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('transaction_id')->unsigned()->nullable();
            $table->string('code',36);
            $table->timestamps();
        });
        Schema::create('class_status_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('class_status_id')->unsigned();
            $table->string('name');
//            $table->string('description');
            $table->string('locale', 10)->index();

            $table->unique(['class_status_id','locale']);
            $table->foreign('class_status_id')->references('id')->on('class_statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_status_translations');
        Schema::dropIfExists('class_statuses');
    }
}
