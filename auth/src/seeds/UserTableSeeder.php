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
             ['user', 'user@gmail.com', 'user'],
             ['admin' ,'admin@gmail.com', 'admin'],
         ];

         foreach($users as $user){
             User::create([
                 'username' => $user[0],
                 'email' => $user[1],
                 'password' => \Hash::make($user[2])
             ]);
         }

    }
}
