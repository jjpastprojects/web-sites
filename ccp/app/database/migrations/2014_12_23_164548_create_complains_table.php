<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplainsTable extends Migration {
	public function up()
	{
		Schema::create('complains',function($t){
			$t->increments('id');
			$t->integer('click_id');
			$t->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('complains');
	}
}
