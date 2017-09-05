<?php

namespace App\Http\Controllers;
use App\Repositories\RaffleRepository;
use App\Repositories\QuestionRepository;
use App\Http\Requests\CreateAnswerRequest;
use App\Repositories\UserAnswerRepository;

class ParticipeController extends Controller
{
    protected $raffleRepo;

    protected $questionRepo;

    protected $userAnswerRepo;

    public function __construct(RaffleRepository $raffleRepo, QuestionRepository $questionRepo, UserAnswerRepository $userAnswerRepo)
    {
        $this->raffleRepo = $raffleRepo;
        $this->questionRepo = $questionRepo;
        $this->userAnswerRepo = $userAnswerRepo;
    }

    /**
     * participe in a raffle
     *
     * @param  integer  $id
     * @return Response
     */
    public function index($raffle_id)
    {
        $raffle = $this->raffleRepo->find($raffle_id);
        return view('participe.index', compact('raffle'));
    }

    /**
     * show the question page
     *
     * @param  integer  $raffle_id
     * @return Response
     */
    public function show($raffle_id)
    {
        $raffle = $this->raffleRepo->find($raffle_id);
        if($raffle->hasNextQuestion()){
            return view('participe.show', compact('raffle'));
        }else{
            return view('participe.score', compact('raffle'));
        }
    }

    /**
     * store anwser
     *
     * @param  integer  $raffle_id
     * @param  integer  $question_id
     * @return Response
     */
    public function store($raffle_id, $question_id, CreateAnswerRequest $request)
    {
        $this->userAnswerRepo->create([
            'answer' => $request->get('answer'),
            'user_id' => auth()->user()->id,
            'question_id' => $question_id,
            'raffle_id' => $raffle_id,
        ]);

        $raffle = $this->raffleRepo->find($raffle_id);

        return redirect()->route('participe.show', ['raffle_id' => $raffle_id]);
    }

}
