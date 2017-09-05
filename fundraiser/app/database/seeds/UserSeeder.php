<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UserSeeder extends DatabaseSeeder{
    public function run() {
        $users=[
            [ 
                "userid" => "testuser",
                "password" => Hash::make("testuser"),
                "email" => "testuser@example.com",
                
            ]
        ];
        
        foreach ($users as $user){
            User::create($user);
        }
    }
}
