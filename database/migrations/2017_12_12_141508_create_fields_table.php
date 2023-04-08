<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('priority')->default(10);
            $table->integer('form_id')->unsigned();
            $table->string('name',45);
            $table->boolean('visible')->default(true);
            $table->boolean('nullable')->default(true);
            $table->boolean('required')->default(false);
            $table->boolean('unique')->default(false);
            $table->boolean('readonly')->default(false);
            $table->string('default_val')->nullable();
            $table->string('type')->default('string');
            $table->string('element')->default('text');
            $table->timestamps();
        });

        Schema::create('field_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('field_id')->unsigned();
            $table->string('placeholder')->nullable();
            $table->string('label')->nullable();
            $table->string('locale', 10)->index();

            $table->unique(['field_id','locale']);
            $table->foreign('field_id')->references('id')->on('fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_translations');
        Schema::dropIfExists('fields');
    }
}
