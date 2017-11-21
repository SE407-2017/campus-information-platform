<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text("comment");
            $table->integer('user_id')->unsigned();
            $table->integer('activity_id')->unsigned();
            $table->timestamps();
            $table->foreign("user_id")->references("id")->on('users');
            $table->foreign("activity_id")->references("id")->on('activities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
