<?php

use Lem\Page\Models\UserPage;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserPageTableSeeder extends Seeder {
    protected $userPages = [
        [1, 1, 1, 10, 0, 0, 0],
        [2, 1, 2, 20, 1, 0, 0],
    ];

    public function run()
    {

        foreach($this->userPages as $userPage)
        {
            UserPage::create([
                'id' => $userPage[0],
                'user_id' => $userPage[1],
                'page_id' => $userPage[2],
                'score' => $userPage[3],
                'isReaded' => $userPage[4],
                'inTrash' => $userPage[5],
                'isSaved' => $userPage[6],
            ]);
        }
    }
}
