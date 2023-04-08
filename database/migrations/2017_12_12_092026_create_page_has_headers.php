<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageHasHeaders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_has_headers', function (Blueprint $table) {
            $table->integer('page_id')->unsigned();
            $table->foreign('page_id')
                ->references('id')
                ->on('pages');
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
        Schema::dropIfExists('page_has_headers');
    }
}
