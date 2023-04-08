<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned()->nullable();
            $table->integer('priority')->unsigned()->defaul(50);
            $table->string('name',45);
            $table->boolean('visible')->default(true);
            $table->string('href')->nullable();
            $table->string('href_type')->default('_self');
            $table->timestamps();
        });

        Schema::create('item_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned();
            $table->string('title');
            $table->string('locale', 10)->index();

            $table->unique(['item_id','locale']);
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_translations');
        Schema::dropIfExists('items');
    }
}
