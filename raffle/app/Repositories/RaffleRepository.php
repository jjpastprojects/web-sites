<?php

namespace App\Repositories;

use App\Models\Raffle;
use App\Models\UserRaffleEntry;

class RaffleRepository extends Repository
{
    protected $model;

    protected $entry;

    public function __construct(Raffle $model, UserRaffleEntry $entry)
    {
        $this->model = $model;
        $this->entry = $entry;
    }

    /**
     * completed raffles
     *
     * @return Raffle
     */
    public function completedRaffles()
    {
        $raffle_ids = $this->entry
            ->where('user_id', auth()->user()->id)
            ->where('complete', 1)
            ->lists('raffle_id');

        $raffles = $this->model->whereIn('id', $raffle_ids)->get();

        return $raffles;
    }

}
