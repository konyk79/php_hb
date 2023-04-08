<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',45);
            $table->boolean('visible')->default(true);
            $table->string('image')->default('')->nullable();
            $table->string('video')->default('')->nullable();
            $table->string('href')->default('')->nullable();
            $table->integer('contentable_id')->unsigned();
            $table->string('contentable_type')->nullable();
            $table->timestamps();
        });

        Schema::create('content_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('content_id')->unsigned();
            $table->string('title')->default('')->nullable();
            $table->string('href_title')->default('')->nullable();
            $table->text('body')->nullable();
            $table->string('locale', 10)->index();

            $table->unique(['content_id','locale']);
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_translations');
        Schema::dropIfExists('contents');
    }
}
