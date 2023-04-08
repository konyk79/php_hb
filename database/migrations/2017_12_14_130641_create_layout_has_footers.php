<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLayoutHasFooters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_has_footers', function (Blueprint $table) {
            $table->integer('layout_id')->unsigned();
            $table->foreign('layout_id')
                ->references('id')
                ->on('layouts');
            $table->integer('footer_id')->unsigned();
            $table->foreign('footer_id')
                ->references('id')
                ->on('footers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layout_has_footers');
    }
}
