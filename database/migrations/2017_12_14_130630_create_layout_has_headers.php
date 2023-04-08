<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayoutHasHeaders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_has_headers', function (Blueprint $table) {
            $table->integer('layout_id')->unsigned();
            $table->foreign('layout_id')
                ->references('id')
                ->on('layouts');
            $table->integer('header_id')->unsigned();
            $table->foreign('header_id')
                ->references('id')
                ->on('headers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layout_has_headers');
    }
}
