<?php namespace Ccp\Admin;


use DB;
use Carbon\Carbon;


class Buyers
{
    private $activate,$finish,$begin_time, $end_time, $order_by, $columns;
    private $buyers;


    //function __construct()
    //{
        //$this->activate = 0;
        //$this->finish = 0;
        //$this->begin_time  = Carbon::now()->subDays(1);
        //$this->end_time = Carbon::now();
        //$this->order_by = 'created_at';
        //$this->columns = ['paypal','amount','img','ccp','email','phone_number'];
        //$this->EffectConditions();
    //}


    function __construct($activate=0, $finish=0, $begin_time='', $end_time='', $order_by='created_at', $columns=['paypal','amount','img','ccp','email','phone_number'])
    {
        $this->activate = $activate;
        $this->finish =$finish;
        $this->begin_time = ($begin_time=='')?Carbon::now()->subDays(1):$begin_time;
        $this->end_time = ($end_time=='')?Carbon::now():$end_time;
        $this->order_by = $order_by;
        $this->columns = $columns;
        $this->EffectConditions();
    }


    function getBuyers()
    {
        return $this->buyers;
    }

    public function EffectConditions()
    {
        $this->buyers = DB::table('buys')
            ->whereActivate($this->activate)
            ->whereFinish($this->finish)
            ->where("created_at", ">", $this->begin_time)
            ->where('created_at', '<', $this->end_time)
            ->orderBy($this->order_by)
            ->get($this->columns);
    }

}
