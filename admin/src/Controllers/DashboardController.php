<?php

namespace Lembarek\Admin\Controllers;


class DashboardController extends Controller
{


    /**
     * the home(index) page of the dashboard
     *
     * @return Response
     */
    public function index($page="dashboard")
    {
        return view('admin::dashboard.index', compact('page'));
    }
}
