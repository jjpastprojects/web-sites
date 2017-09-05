<?php

class UsersTableSeeder extends Seeder{

    protected $users = [
        [1, 'lem', 'lem@gmail.com', 'secret'],
    ];

   public function run()
   {

     foreach($this->users as $user){
         User::create([
                'id' => $user[0],
                'username' => $user[1],
                'email' => $user[2],
                'password' => Hash::make($user[3]),
        ]);
    }
    }
}
