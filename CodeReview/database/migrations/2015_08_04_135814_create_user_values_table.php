<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_values', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->integer('user_id')->unsigned();
                        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                        $table->integer('variable_id')->unsigned();
                        $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade');
                        $table->text('values');
                        $table->unique(['user_id', 'variable_id']);
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
		Schema::drop('user_values');
	}

}
