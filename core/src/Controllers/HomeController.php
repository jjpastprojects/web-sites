<?php

 namespace Lembarek\Core\Controllers;

class HomeController extends Controller
{

    /**
    * construct
    *
    * @return void
    */
    public function __construct()
    {
    }

    /**
     * redirect the users to the home page
     *
     * @return Response
     */
    public function home()
    {
        return view('core::home.index');
    }
}
