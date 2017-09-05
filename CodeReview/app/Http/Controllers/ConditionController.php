<?php namespace App\Http\Controllers;
// code...
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Lem\Condition\Condition;

class ConditionController extends Controller {

    public function test()
    {
        $condition = new Condition("(sdflkdsjf)");
    }

}
