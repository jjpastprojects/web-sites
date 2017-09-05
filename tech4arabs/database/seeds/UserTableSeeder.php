<?php

use Illuminate\Database\Seeder;
use Lembarek\Auth\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $users = [
             [1, 'user', 'user@gmail.com', 'user'],
             [2, 'admin' ,'admin@gmail.com', 'admin'],
         ];

         foreach($users as $user){
             User::create([
                 'id' => $user[0],
                 'username' => $user[1],
                 'email' => $user[2],
                 'password' => \Hash::make($user[3])
             ]);
         }

    }
}
