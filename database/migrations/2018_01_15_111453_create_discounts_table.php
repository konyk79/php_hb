<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 64);
            $table->float('discount');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
        Schema::create('discount_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('discount_id')->unsigned();
            $table->string('name');
//            $table->string('description');
            $table->string('locale', 10)->index();

            $table->unique(['discount_id','locale']);
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_translations');
        Schema::dropIfExists('discounts');
    }
}
