<?php

use Cache;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class QuestionControllersTest extends TestCase {

    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();
        $user = createUser();
        login($user);

        $this->raffle = createRaffle();
        Cache::put('raffle_id', $this->raffle->id, 60);
    }

    /**
    * @test
    */
    public function it_create_a_new_multiple_qestion()
    {
        $this->visit(route('question.create'));
        $this->seePageIs(route('question.create'));
        $this->type('question description', 'description');
        $this->type('answer 1', 'answers[1]');
        $this->type('answer 2', 'answers[2]');
        $this->type('answer 3', 'answers[3]');
        $this->type('answer 4', 'answers[4]');
        $this->select('3', 'correct_answer');
        $this->press('next Question');

        $this->seeInDatabase('questions', ['description' => 'question description', 'raffle_id' => $this->raffle->id, 'type' => 'multiple']);
        $this->seeInDatabase('answers', ['answer' => 'answer 3']);
        $this->seeInDatabase('multi_choices', ['answer' => 'answer 1']);
        $this->seeInDatabase('multi_choices', ['answer' => 'answer 2']);
        $this->seeInDatabase('multi_choices', ['answer' => 'answer 3']);
        $this->seeInDatabase('multi_choices', ['answer' => 'answer 4']);
    }

    /**
    * @test
    **/
    public function it_create_a_quantative_question()
    {
        $question_type = "quantative";
        $this->visit(route('question.create', compact('question_type')));
        $this->seePageIs(route('question.create', compact('question_type')));
        $this->type('question description', 'description');
        $this->press('next Question');

        $this->seeInDatabase('questions', [
            'description' => 'question description',
            'raffle_id' => $this->raffle->id,
            'type' => 'quantative',
        ]);
    }

    /**
    * @test
    **/
    public function it_create_qualitative_question()
    {
        $question_type = "qualitative";
        $this->visit(route('question.create', compact('question_type')));
        $this->seePageIs(route('question.create', compact('question_type')));
        $this->type('question description', 'description');
        $this->press('next Question');

        $this->seeInDatabase('questions', [
            'description' => 'question description',
            'raffle_id' => $this->raffle->id,
            'type' => 'qualitative',
        ]);
    }

}
