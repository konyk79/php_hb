<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
//            $table->integer('transaction_id')->unsigned()->nullable();
            $table->string('code',36);
            $table->timestamps();
        });
        Schema::create('type_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id')->unsigned();
            $table->string('name');
//            $table->string('description');
            $table->string('locale', 10)->index();

            $table->unique(['type_id','locale']);
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_translations');
        Schema::dropIfExists('types');
    }
}
