<?php

namespace App\Models;

class UserAnswer extends Model
{
        protected $fillable = ['raffle_id', 'user_id', 'question_id', 'answer'];
}
