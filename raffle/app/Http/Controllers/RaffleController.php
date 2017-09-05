<?php

namespace App\Http\Controllers;

use Cache;
use App\Http\Requests\CreateRaffleRequest;
use App\Repositories\RaffleRepository;
use App\Services\UploadManager;

class RaffleController extends Controller
{
    protected $raffleRepo;

    protected $manager;

    public function __construct(RaffleRepository $raffleRepo, UploadManager $manager)
    {
        $this->raffleRepo = $raffleRepo;
        $this->manager = $manager;
    }

    /**
     * show raffles
     *
     * @return Response
     */
    public function index()
    {
        $raffles = $this->raffleRepo->all();
        return view('raffle.index', compact('raffles'));
    }

    /**
     * show the form for the raffle
     *
     * @return Response
     */
    public function create()
    {
        return view('raffle.create');
    }

    /**
     * store a new raffle
     *
     * @return Response
     */
    public function store(CreateRaffleRequest $request)
    {
        $image = $request->file('image');

        $raffle = $this->raffleRepo->create(array_merge($request->except('_token'), ['img' => $image->getClientOriginalName()]));

        $this->manager->uploadImage($image);

        Cache::put('raffle_id', $raffle->id, 60);

        return view('questions.create');
    }

    /**
     * show the complete raffles
     *
     * @return Response
     */
    public function completed()
    {
        $raffles = auth()->user()->completedRaffles();
        return view('raffle.completed', compact('raffles'));
    }

    /**
     * show the ongoing raffles
     *
     * @return Response
     */
    public function ongoing()
    {
        $raffles = auth()->user()->ongoingRaffles();
        return view('raffle.ongoing', compact('raffles'));
    }


}
