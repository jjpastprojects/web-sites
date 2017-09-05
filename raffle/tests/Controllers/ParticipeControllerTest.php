<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;


class ParticipeControllerTest extends \TestCase {
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->user = createUser();

        login($this->user);
    }

    /**
    * @test
    */
    public function it_participe_in_a_raffle()
    {
        $raffle = createRaffle();
        $questions = createQuestion([], 3);

        $this->visit(route('participe.index', ['raffle_id' => $raffle->id]));
        $this->seePageIs(route('participe.index', ['raffle_id' => $raffle->id]));
        $this->see(route('participe.show', ['raffle_id' => $raffle->id]));
    }

    /**
    * @test
    */
    public function it_ask_the_first_question()
    {
        $raffle = createRaffle();
        $questions = createQuestion(['type' => 'multiple'], 3);
        $firstQuestion = $questions[0];
        $multiChoices = createMultiChoice(['question_id' => $firstQuestion->id], 4);

        $this->visit(route('participe.show', ['raffle_id' => $raffle->id]));
        $this->select($multiChoices[0]->answer, 'answer');
        $this->see($firstQuestion->description);
        $this->press('Next Question');

        $this->seeInDatabase('user_answers', [
            'user_id' => $this->user->id,
            'question_id' => $firstQuestion->id,
            'raffle_id' => $raffle->id,
            'answer' => $multiChoices[0]->answer,
        ]);
    }

    /**
    * @test
    */
    public function it_show_the_score()
    {
        $faker = \Faker\Factory::create();
        $raffle = createRaffle();
        $questions = createQuestion(['type' => 'multiple'], 10);
        $i=0;
        foreach($questions as $question){
            $answer = $faker->word;
            createAnswer(['question_id' => $question->id, 'answer' => $answer]);
            createMultiChoice(['question_id' => $question->id, 'answer' => $answer]);
            createMultiChoice(['question_id' => $question->id], 3);
            if(($i++)%2 ==0)
                createUserAnswer([
                    'raffle_id' => $raffle->id,
                    'question_id' => $question->id,
                    'user_id' => $this->user->id,
                    'answer' => $answer
                ]);
            else
                createUserAnswer([
                    'raffle_id' => $raffle->id,
                    'question_id' => $question->id,
                    'user_id' => $this->user->id,
                ]);

        }

        $this->assertEquals(50, $raffle->score());
   }

}
