<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMultipleQuestionRequest;
use App\Http\Requests\CreateQuantativeQuestionRequest;
use App\Http\Requests\CreateQualitativeQuestionRequest;
use App\Repositories\QuestionRepository;
use App\Repositories\AnswerRepository;
use App\Repositories\MultiChoiceRepository;

class QuestionController extends Controller
{

    protected $questionRepo;

    protected $answerRepo;

    protected $multiChoiceRepo;

    public function __construct(QuestionRepository $questionRepo, AnswerRepository $answerRepo, MultiChoiceRepository $multiChoiceRepo)
    {
        $this->questionRepo = $questionRepo;
        $this->answerRepo = $answerRepo;
        $this->multiChoiceRepo = $multiChoiceRepo;
    }

    /**
     * create a new question and attach it with a raffle
     *
     * @return Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * store a Multiple
     *
     * @return Response
     */
    public function storeMultiple(CreateMultipleQuestionRequest $request)
    {
        $multiple_choices = head($request->only('answers'));

        $question = $this->questionRepo->create(array_merge($request->only('description', 'raffle_id'), ['type' => 'multiple']));

        $correctAnswer  = $multiple_choices[head($request->only('correct_answer'))];

        $answer = $this->answerRepo->create(['answer' => $correctAnswer, 'question_id' => $question->id]);

        array_map(function($choice)use($question){
            $this->multiChoiceRepo->create(['question_id' => $question->id, 'answer' => $choice]);
        }, $multiple_choices);


        return  view('questions.create');
    }

    /**
     * store a quantative question
     *
     * @return Response
     */
    public function storeQuantative(CreateQuantativeQuestionRequest $request)
    {
        $question = $this->questionRepo->create(
            array_merge($request->only('description', 'raffle_id'), ['type' => 'quantative'])
        );

        return view('questions.create');
    }

    /**
    * @test
    **/
    public function storeQualitative(CreateQualitativeQuestionRequest $request)
    {
        $question = $this->questionRepo->create(
            array_merge($request->only('description', 'raffle_id'),['type' => 'qualitative'])
        );

        return view('questions.create');
    }

}
