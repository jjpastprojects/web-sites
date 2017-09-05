<?php namespace App\Http\Controllers;

use App\Facades\Profile;
use App\Facades\Code;
use App\Facades\User;

use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VariableController extends Controller {


        public function __construct()
        {
            $this->middleware('admin');
        }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('variable.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
            $name = $request->get('name');
            $type = $request->get('type');
            $min = $request->get('min');
            $max = $request->get('max');
            $values = $request->get('values');
            $code = $request->get('code');


            $variable = Profile::createVariable([
                'name' => $name,
                'type' => $type,
                'min' => $min,
                'max' => $max
                ]);


            if($type == "enum")
                Profile::createEnum([
                    'variable_id' => $variable->id,
                    'values' => $values
                    ]);


            Code::execute($code, ['current_user_id' =>  User::getCurrentUser()->id]);


            return Redirect::back();

	}


}
