<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session, Redirect, Lang;

class LanguageController extends Controller {

    public function chooser(Request $request)
    {

        Session::set('locale', $request->get('locale'));

        return Redirect::back();
    }
}
