<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {
	public function up()
	{
		Schema::create('messages',function($t){
			$t->increments('id');
			$t->integer('user_id');
			$t->enum('status',array('delete','read','not_read'));
			$t->text('subject');
			$t->text('body');
			$t->timestamps();
		});
	}
	public function down()
	{
		Schema::drop('messages');
	}

}
