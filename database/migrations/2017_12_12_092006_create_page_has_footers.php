<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageHasFooters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_has_footers', function (Blueprint $table) {
            $table->integer('page_id')->unsigned();
            $table->foreign('page_id')
                ->references('id')
                ->on('pages');
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
        Schema::dropIfExists('page_has_footers');
    }
}
