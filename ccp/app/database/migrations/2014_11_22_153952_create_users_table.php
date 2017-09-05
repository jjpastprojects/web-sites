<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users',function($table){
			$table->increments('id');
			$table->string('email',60);
			$table->string('username',20);
			$table->string('password',60);
			$table->string('passwrod_temp',60);
			$table->string('code',60);
			$table->integer('active');
			$table->integer('level');
			$table->timestamps();
			$table->string('remember_token');
		});
	}

	public function down()
	{
		Schema::drop('users');
	}

}
