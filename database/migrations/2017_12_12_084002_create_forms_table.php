<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('view_id')->unsigned();
            $table->string('name',45);
            $table->string('model')->nullable();
            $table->boolean('visible')->default(true);
            $table->string('action');
            $table->string('method',10)->default('POST');
            $table->timestamps();
        });
        Schema::create('form_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('form_id')->unsigned();
            $table->string('title')->nullable();
            $table->text('body_text')->nullable();
            $table->text('submit_title')->nullable();
            $table->text('cancel_title')->nullable();
            $table->text('error_text')->nullable();
            $table->text('success_text')->nullable();
            $table->string('locale', 10)->index();

            $table->unique(['form_id','locale']);
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_translations');
        Schema::dropIfExists('forms');
    }
}
