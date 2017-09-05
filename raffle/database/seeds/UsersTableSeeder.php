<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         $users = [
             ['user@example.com', 'user'],
             ['admin@example.com', 'admin'],
         ];

         foreach($users as $user){
             User::create([
                 'email' => $user[0],
                 'password' => \Hash::make($user[1])
             ]);
         }

    }
}
