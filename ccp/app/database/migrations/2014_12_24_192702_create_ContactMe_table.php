<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactMeTable extends Migration {

	public function up()
	{
		Schema::create('contact_me',function($t){
			$t->increments('id');
			$t->integer('user_id');
			$t->text('subject');
			$t->text('message');
			$t->enum('status',array('readed','not_readed'));
			$t->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contact_me');
	}
}
