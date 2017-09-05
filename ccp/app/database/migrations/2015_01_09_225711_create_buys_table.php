<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuysTable extends Migration {

	public function up()
	{
		Schema::create('buys',function($t){
			$t->increments('id');
			$t->text('paypal');
			$t->integer('amount');
                        $t->text('img');
			$t->integer('ccp');
			$t->text('email');
			$t->integer('phone_number');
			$t->integer('activate');
			$t->integer('txn_id');
			$t->integer('finish');
			$t->timestamps();
		});
	}
	public function down()
	{
		Schema::drop('buys');
	}

}
