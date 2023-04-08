<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_status_id')->unsigned();
            $table->integer('teacher_id')->unsigned();
            $table->integer('schedule_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('class_level_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->boolean('visible')->default(true);
            $table->boolean('is_active')->default(true);
//            $table->string('time_out', 10)->nullable();
            $table->string('term', 10)->nullable();
            $table->dateTime('start_time');
            $table->string('color',10);
            $table->timestamps();
        });
        Schema::create('lesson_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->unsigned();
            $table->string('name');
            $table->string('term_text');
            $table->string('description');
            $table->string('locale', 10)->index();

            $table->unique(['lesson_id','locale']);
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_translations');
        Schema::dropIfExists('lessons');
    }
}
