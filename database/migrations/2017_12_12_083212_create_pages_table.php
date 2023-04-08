<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('layout_id')->unsigned();
            $table->integer('view_id')->unsigned();
            $table->string('name',45);
         //   $table->string('favicon')->nullable();  //not use yet
            $table->boolean('visible')->default(true);
            $table->boolean('is_need_authentificate')->default(false); //not use yet
            $table->timestamps();
        });
        Schema::create('page_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->string('title',45)->nullable();
            $table->string('favicon_title',25);
           // $table->text('body')->nullable();  //not use yet
            $table->string('locale', 10)->index();

            $table->unique(['page_id','locale']);
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_translations');
        Schema::dropIfExists('pages');
    }
}
