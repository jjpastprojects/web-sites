<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enums', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->integer('variable_id')->unsigned()->unique();
                        $table->text('values');
                        $table->foreign('variable_id')->references('id')->on('variables')->onDelete('cascade')->onUpdate('cascade');
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
		Schema::drop('enums');
	}

}
