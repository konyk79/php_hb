<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->text('image')->nullable();
            $table->boolean('visible')->default(true);
            $table->text('name')->nullable();
            $table->timestamps();
        });
        Schema::create('review_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('review_id')->unsigned();
            $table->string('locale',10)->index();

            $table->text('body');  // tag field for translatable

            $table->unique(['review_id','locale']);
            $table->foreign('review_id')->references('id')->on('reviews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_translations');
        Schema::dropIfExists('reviews');
    }
}
