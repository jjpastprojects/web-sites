<?php

namespace Lembarek\Core\Controllers;

class CoreController extends Controller
{


    public function __construct()
    {
    }

    /**
     * set the local langauge
     *
     * @return Response
     */
    public function setLang()
    {
        $locale = request()->only('l')['l'];
        app()->setLocale($locale);
        return back();
    }


}
