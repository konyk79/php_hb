<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subitems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_id')->unsigned()->nullable();
            $table->integer('priority')->unsigned()->defaul(50);
            $table->string('name',45);
            $table->boolean('visible')->default(true);
            $table->string('href');
            $table->string('href_type')->default('_self');
            $table->timestamps();
        });

        Schema::create('subitem_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('subitem_id')->unsigned();
            $table->string('title');
            $table->string('locale', 10)->index();

            $table->unique(['subitem_id','locale']);
            $table->foreign('subitem_id')->references('id')->on('subitems')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subitem_translations');
        Schema::dropIfExists('subitems');
    }
}
