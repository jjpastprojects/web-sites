<?php

class DatabaseSeeder extends Seeder {

        protected $tables = [
        'users',
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
