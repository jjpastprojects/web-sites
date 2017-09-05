<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellsTable extends Migration {

	public function up()
	{
		Schema::create('sells',function($t){
			$t->increments('id');
			$t->text('paypal');
                        $t->text('paypal_first_name');
                        $t->text('paypal_last_name');
			$t->integer('amount');
			$t->integer('ccp');
			$t->text('first_name');
			$t->text('last_name');
			$t->text('email');
			$t->integer('phone_number');
			$t->integer('activate');
			$t->timestamps();
		});
	}
	public function down()
	{
		Schema::drop('sells');
	}

}
