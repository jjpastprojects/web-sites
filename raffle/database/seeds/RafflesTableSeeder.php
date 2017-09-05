<?php

use Illuminate\Database\Seeder;
use App\Models\Raffle;
use App\Models\Question;
use App\Models\MultiChoice;

class RafflesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

         $raffles = [
             ['title', 'mechanics', 'rules', 100, '01-01-2016', 'a.jpg'],
         ];

         $questions = [
             ['question 1', 'multiple'],
             ['question 2', 'multiple'],
             ['question 3', 'multiple'],
             ['question 4', 'multiple'],
             ['question 5', 'multiple'],
         ];

         foreach($raffles as $raffle){
             $r = createRaffle([
                 'title' => $raffle[0],
                 'mechanics' => $raffle[1],
                 'rules' => $raffle[2],
                 'prize' => $raffle[3],
                 'deadline' => $raffle[4],
                 'img' => $raffle[5],
             ]);
             foreach($questions as $question){
                 $q = createQuestion(['raffle_id' => $r->id, 'description' => $question[0], 'type' => $question[1]]);
                 if($question[1] == 'multiple'){
                     $correct_answer = $faker->word;
                     createAnswer(['question_id' => $q->id, 'answer' => $correct_answer]);
                     createMultiChoice(['question_id' => $q->id, 'answer' => $correct_answer]);
                     createMultiChoice(['question_id' => $q->id, 'answer' => $faker->word], 3);
                 }
             }
         }

    }
}
