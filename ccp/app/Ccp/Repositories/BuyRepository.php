<?php namespace Ccp\Repositories;

use Ccp\Models\Buy;
use Ccp\Interfaces\BuyInterface;

class BuyRepository extends Repository implements BuyInterface
{

    protected  $model;

    public function __construct(Buy $buy)
    {
        $this->model = $buy;
    }

    /**
     * check if the buy is active
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->model->where('activate','=',0)->sum('amount') < \Config::get('constants.buy_avialable_dollar');

    }


}
