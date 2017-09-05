<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
                        $table->increments("id");
                        
                        $table->string("userid");
                        $table->string("remember_token");
                        $table->string("password");
                        $table->string("email");
                        $table->dateTime("created_at");
                        $table->dateTime("updated_at");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::dropIfExists("users");
		
	}

}
