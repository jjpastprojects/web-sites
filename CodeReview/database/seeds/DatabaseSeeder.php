<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder {

        protected $tables = [
        'users',
        'variables',
        'user_variables',
        'enums',
        'user_values',
        'tasks',
        'site_values',
        'pages',
        'user_page',
        'roles',
        'role_user',
        ];


	public function run()
	{
		Eloquent::unguard();

                $this->cleanDatabase();

                foreach ($this->tables as $seedClass) {
                    $this->call(ucfirst(camel_case($seedClass)).'TableSeeder');
                }
	}


        public function cleanDatabase()
        {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            foreach ($this->tables as $table) {
                DB::table($table)->truncate();
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

}
