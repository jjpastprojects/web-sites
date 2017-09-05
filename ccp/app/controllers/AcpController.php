<?php

use Ccp\Repositories\BuyRepository;

class AcpController extends Controller
{

    private $buyRepo;

    /**
    * construct
    *
    * @return void
    */
    public function __construct(BuyRepository $buyRepo)
    {
        $this->buyRepo  = $buyRepo;
    }

    /**
     * get all buys
     *
     * @return Response
     */
    public function getBuys()
    {
        $buys = $this->buyRepo->all();
        return View::make('acp.buys.index', compact('buys'));
    }

}

