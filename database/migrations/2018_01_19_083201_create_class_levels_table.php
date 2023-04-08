<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_levels', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('transaction_id')->unsigned()->nullable();
            $table->string('code',36);
            $table->timestamps();
        });
        Schema::create('class_level_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('class_level_id')->unsigned();
            $table->string('name');
//            $table->string('description');
            $table->string('locale', 10)->index();

            $table->unique(['class_level_id','locale']);
            $table->foreign('class_level_id')->references('id')->on('class_levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_level_translations');
        Schema::dropIfExists('class_levels');
    }
}
