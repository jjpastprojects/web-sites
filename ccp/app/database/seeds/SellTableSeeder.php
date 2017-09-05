<?php

class SellTableSeeder extends Seeder{
    public function run(){
        Sell::create(array("id" => 1, "paypal" => "a@a.a","amount" => 10, "ccp" => 23432432, "first_name" => "a", "last_name" => "a", "email" => "a@a.a", "phone_number" => 324324324,));
        Sell::create(array("id" => 2, "paypal" => "b@b.b","amount" => 20, "ccp" => 2423432423, "first_name" => "b", "last_name" => "b", "email" => "b@b.b", "phone_number" => 32432432,));
        }
}
