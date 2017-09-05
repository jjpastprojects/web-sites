<?php

class RolesTableSeeder extends Seeder{

    protected $users = [
        [1, 'admin'],
    ];

   public function run()
   {

     foreach($this->users as $user){
         Role::create([
                'id' => $user[0],
                'name' => $user[1],
        ]);
    }
    }
}
