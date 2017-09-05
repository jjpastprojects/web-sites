<?php namespace Ccp\Repositories;

use Ccp\Interfaces\SellInterface;
use Ccp\Models\Sell;

class SellRepository extends Repository implements SellInterface
{

    protected $model;

    public function __construct(Sell $model)
    {
        $this->model = $model;
    }

    /**
     * check if the sell is active
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->model->where('activate','=',0)->sum('amount') < \Config::get('constants.sell_avialable_dollar');

    }


}
