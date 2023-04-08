<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('countries', function (Blueprint $table) {
                $table->increments('id');
                $table->string('code', 5)->unique();
                $table->timestamps();
            });
            Schema::create('country_translations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('country_id')->unsigned();
                $table->string('locale', 10)->index();

                $table->string('name',65)->unique();  // tag field for translatable

                $table->unique(['country_id','locale']);
                $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_translations');
        Schema::dropIfExists('countries');
    }
}
