<?php

 namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];


    /**
     * The attributes excluded from the models JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * return all completed raffles
     *
     * @return Raffle
     */
    public function completedRaffles()
    {
        $raffles =  Raffle::get()->filter(function($raffle){
            return $raffle->isCompleted();
        });
        return $raffles;
    }

     /**
     * return all completed raffles
     *
     * @return Raffle
     */
    public function ongoingRaffles()
    {
        $raffles =  Raffle::get()->filter(function($raffle){
            return $raffle->isOngoing();
        });
        return $raffles;
    }

}
