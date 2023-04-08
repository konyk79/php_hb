<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image')->nullable();
            $table->boolean('visible')->default(true);
            $table->timestamps();
        });

        Schema::create('news_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('news_id')->unsigned();
            $table->string('title',65)->nullable();
            $table->string('description')->nullable();
            $table->text('body')->nullable();
            $table->string('locale', 10)->index();

            $table->unique(['news_id','locale']);
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_translations');
        Schema::dropIfExists('news');
    }
}
