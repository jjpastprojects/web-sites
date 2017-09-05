<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function __construct()
    {
    }

    /**
     * it show the home page
     *
     * @return Response
     */
    public function home()
    {
        return view('home.index');
    }

}
