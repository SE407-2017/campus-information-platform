<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
          $table->increments('id');
          $table->string("adminname")->unique();
          $table->string("email")->nullable()->unique();
          $table->string("phone")->unique()->nullable();
          $table->string("password");
          $table->string("avatar_url")->nullable();
          $table->text("intro")->nullable();
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
        Schema::drop('admins');
    }
}
