<?php

class RoleUserTableSeeder extends Seeder{

    protected $values = [
        [1, 1, 1],
    ];

   public function run()
   {
        foreach($this->values as $value){
            DB::table('role_user')->insert([
                    'id' => $value[0],
                    'role_id' => $value[1],
                    'user_id' => $value[2],
            ]);
         }
    }
}
