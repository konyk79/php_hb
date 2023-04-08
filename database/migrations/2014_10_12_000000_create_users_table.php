<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('language_id')->unsigned()->nullable();
            $table->integer('type_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('last_name');
            $table->string('phone',15);
            $table->string('email', 65)->unique();
            $table->boolean('email_confirmed')->default(false);
            $table->string('email_confirmation_code', 65)->nullable();
            $table->string('password');
            $table->string('corporate_name',126)->nullable();
            $table->string('corporate_web',126)->nullable();
            $table->text('about_me')->nullable();
            $table->string('photo')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
