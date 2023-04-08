<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageHasContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('page_has_contents', function (Blueprint $table) {
//            $table->integer('page_id')->unsigned();
//            $table->foreign('page_id')
//                ->references('id')
//                ->on('pages');
//            $table->integer('content_id')->unsigned();
//            $table->foreign('content_id')
//                ->references('id')
//                ->on('contents');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('page_has_contents');
    }
}
