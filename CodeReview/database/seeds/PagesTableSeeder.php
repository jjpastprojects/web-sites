<?php

use Lem\Page\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PagesTableSeeder extends Seeder {
    protected $pages = [
        [1, "laravel job1", '<h1>you will succeeed in you career using laravel just conitnue</h1>','$score = 0;if(Profile::getValue(#current_user_id, 1) == "male")$score+=10;Page::saveScore(#current_user_id, #current_page_id, $score);'],
        [2, "laravel job2", '<h1>you will succeeed in you career using laravel just conitnue</h1>','$score = 0;if(Profile::getValue(#current_user_id, 1) == "male")$score+=10;Page::saveScore(#current_user_id, #current_page_id, $score);'],
    ];

    public function run()
    {

        foreach($this->pages as $page)
        {

            Page::create([
                'id' => $page[0],
                'title' => $page[1],
                'body' => $page[2],
                'code' => $page[3],
            ]);
        }
    }
}
