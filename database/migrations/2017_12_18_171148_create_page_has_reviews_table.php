<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageHasReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_has_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();
            $table->integer('paginate')->unsigned();
            $table->timestamps();
        });
//        Schema::create('page_has_reviews_translations', function(Blueprint $table) {
//            $table->increments('id');
//            $table->integer('page_has_reviews_id')->unsigned();
//            $table->string('more');
//            $table->string('locale', 10)->index();
//
//            $table->unique(['page_has_reviews_id','locale']);
//            $table->foreign('page_has_reviews_id')->references('id')->on('page_has_reviews')->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_has_reviews');
    }
}
