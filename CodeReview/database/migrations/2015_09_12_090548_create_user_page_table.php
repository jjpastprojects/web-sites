<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPageTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_page', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->integer('page_id')->unsigned();
                $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
                $table->integer('score');
                $table->boolean('isReaded');
                $table->boolean('inTrash');
                $table->boolean('isSaved');
                $table->timestamps();
                $table->unique(['user_id', 'page_id']);
            });

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_page');
    }

}
