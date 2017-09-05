<?php

class AdminController extends BaseController{

    /**
     * index the admin area
     *
     * @return Response
     */
    public function index()
    {
        return View::make('acp.home.index');
    }


    public function get_buyers($active=0, $finish=0, $start_time='', $end_time='', $order_by='created_at', $show=['amount','img','email','phone_number','created_at'])
    {
        $buyers = Buy::whereActive($active)
            ->whereFinish($finish)
            ->where('created_at','>',$start_time)
            ->where('created_at','<',$end_time)
            ->order($order_by)
            ->get($show);
        return $buyers;
    }


    public function show_buyers()
    {
        return $this->get_buyers();
    }


    public function getBuyers()
    {
        return View::make('acp.buyer.search');
    }


}
