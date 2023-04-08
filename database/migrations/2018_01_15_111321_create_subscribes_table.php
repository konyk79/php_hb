<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 64);
            $table->integer('discount_id')->nullable();
            $table->float('price');
            $table->integer('priority')->default(20);
            $table->boolean('is_auto_prolangate')->default(true);
            $table->boolean('is_active')->default(true);
            $table->boolean('visible')->default(true);
            $table->string('term', 64);
            $table->string('expires_for', 64)->nullable()->default(null);
            $table->integer('num_classes');
//            $table->integer('limit_classes');
//            $table->string('limit_term');
            $table->string('trial_term');
            $table->integer('type_id')->unsigned();   //regular, corporate, individual
            $table->timestamps();
        });
        Schema::create('subscribe_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('subscribe_id')->unsigned();
            $table->string('name')->default('');
            $table->string('term_text')->default('');
            $table->string('description')->default('');
            $table->string('locale', 10)->index();

            $table->unique(['subscribe_id','locale']);
            $table->foreign('subscribe_id')->references('id')->on('subscribes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribe_translations');
        Schema::dropIfExists('subscribes');
    }
}
