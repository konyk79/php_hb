<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageHasNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_has_news', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->integer('paginate')->unsigned();
            $table->timestamps();
        });
        Schema::create('page_has_news_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('page_has_news_id')->unsigned();
            $table->string('more_button_text');
            $table->string('locale', 10)->index();

            $table->unique(['page_has_news_id','locale']);
            $table->foreign('page_has_news_id')->references('id')->on('page_has_news')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_has_news_translations');
        Schema::dropIfExists('page_has_news');
    }
}
