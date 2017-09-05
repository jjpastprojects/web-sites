<?php

use Lem\Task\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TasksTableSeeder extends Seeder {
    protected $tasks = [
        [1, 'register', '\App\Facades\Profile::addVariableToUser(#current_user_id, 1);  \App\Facades\Profile::addVariableToUser(#current_user_id, 2);'],
    ];

    public function run()
    {



        foreach($this->tasks as $task)
        {
            Task::create([
                'id' => $task[0],
                'whenCondition' => $task[1],
                'code' => $task[2],
            ]);
        }
    }
}
