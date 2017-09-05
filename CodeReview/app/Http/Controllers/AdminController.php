<?php

namespace App\Http\Controllers;

use App\Facades\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
	$this->middleware('admin');
    }


    /**
     * show all user
     *
     * @param  string  $
     * @return void
     */
    public function showUsers()
    {
        $users = User::all();
        return view('admin.showUsers')->with('users', $users);
    }
}
