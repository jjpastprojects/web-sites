<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_answers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('answer');
            $table->integer('raffle_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('raffle_id')
                  ->references('id')->on('raffles')
                  ->onDelete('cascade');


            $table->foreign('question_id')
                  ->references('id')->on('questions')
                  ->onDelete('cascade');

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->unique(['raffle_id', 'user_id', 'question_id']);

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
        Schema::drop('user_answers');
    }
}
