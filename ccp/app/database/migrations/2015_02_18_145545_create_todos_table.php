<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration {
	public function up()
	{
		Schema::create('todos',function($t){
					$t->increments('id');
					$t->text('body');
					$t->integer('completed');
					$t->timestamps();
					$t->string('remember_token');
				});
				
	}

	public function down()
	{
		Schema::drop('todos');
	}

}
