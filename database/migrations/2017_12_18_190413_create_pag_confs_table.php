<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagConfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pag_confs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
        Schema::create('pag_conf_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('pag_conf_id')->unsigned();
            $table->string('previous');
            $table->string('next');
            $table->string('locale', 10)->index();

            $table->unique(['pag_conf_id','locale']);
            $table->foreign('pag_conf_id')->references('id')->on('pag_confs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pag_conf_translations');
        Schema::dropIfExists('pag_confs');
    }
}
