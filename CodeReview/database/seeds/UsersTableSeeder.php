<?php

use Lem\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder{
    protected $users = [
        [1, 'lem', 'lem@gmail.com', 'secret'],
        [2, 'a', 'a@gmail.com', 'secret'],
        [3, 'b', 'b@gmail.com', 'secret'],
    ];
   public function run()
   {

     foreach($this->users as $user){
         User::create([
                'id' => $user[0],
                'name' => $user[1],
                'email' => $user[2],
                'password' => bcrypt($user[3]),
        ]);
    }
    }
}
