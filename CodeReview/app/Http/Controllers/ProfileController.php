<?php namespace App\Http\Controllers;

use Redirect;
use Lem\Profile\Interfaces\UserVariableInterface;
use Lem\Profile\Interfaces\VariableInterface;
use Lem\Profile\Interfaces\UserValueInterface;
use Lem\Profile\Interfaces\EnumInterface;
use Auth;
use App\Http\Requests;
use App\Http\Requests\EnumRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller {

        protected $userVariableRepo;

        public function __construct(
            UserVariableInterface $userVariableRepo,
            VariableInterface $variableRepo,
            UserValueInterface $userValue,
            EnumInterface $enumRepo
        )
        {

	    $this->middleware('auth');

            $this->userVariableRepo = $userVariableRepo;
            $this->variableRepo = $variableRepo;
            $this->userValue = $userValue;
            $this->enumRepo = $enumRepo;
            $this->current_user = \Auth::user();
        }


        /**
         * show all variable for a users
         *
         * @return view
         */
        public function index()
        {
            $variables = \Profile::getAllVariableWithValue($this->current_user->id)->get();
            return view('profile.index')->with('variables', $variables);
        }


	public function show()
	{
                    $var_id = $this->userVariableRepo->getFirstUndefinedVariableId($this->current_user->id);

                    if($var_id == -1)
                        return view("profile.completeProfile");

                    $variable = $this->variableRepo->find($var_id);

                    $view = "profile.profile";
                    $type = $variable['type'];
                    $name = $variable['name'];
                    $min  = $variable['min'];
                    $max = $variable['max'];

                    if($type == 'enum' ){
                        $values = $this->enumRepo->getValuesByVariableId($var_id);
                        return view($view)->withMin($min)->withMax($max)->withName($name)->withType($type)->withValues($values);
                    }else{
                        return view($view)->withName($name)->withType($type)->withMin($min)->withMax($max);
                    }
	}


	public function show2($var_id)
	{

                    $variable = $this->variableRepo->find($var_id);

                    $view = "profile.profile";
                    $type = $variable['type'];
                    $name = $variable['name'];
                    $min  = $variable['min'];
                    $max = $variable['max'];

                    if($type == 'enum' ){
                        $values = $this->enumRepo->getValuesByVariableId($var_id);
                        return view($view)->withMin($min)->withMax($max)->withName($name)->withType($type)->withValues($values);
                    }else{
                        return view($view)->withName($name)->withType($type)->withMin($min)->withMax($max);
                    }
	}


        public function store(Request $request)
        {
            $name = $request->get('name');
            $var_id =   $this->variableRepo->getVariableByName($name)->id;

            $user_id = $this->current_user->id;

            $values = $request->get(0);
            $i=1;
            while($value = $request->get($i++)){
                $values .= ",".$value;
            }

            $this->userValue->create($user_id,$var_id,$values);

            return Redirect::route('profile');

        }


        /**
         * show for update
         *
         * @param  integer  $variable_id
         * @return void
         */
        public function showForUpdate($variable_id)
        {
            $value = \Profile::getValue($this->current_user->id, $variable_id);
            if($value == 'undefined')
                return Redirect::route('home');

            if(!\Profile::hasVariable($this->current_user->id, $variable_id))
                return Redirect::route('home');

            $variable = \Profile::getVariableById($variable_id);

            $view = "profile.update";
            $type = $variable['type'];
            $name = $variable['name'];
            $min  = $variable['min'];
            $max = $variable['max'];

            if($type == 'enum' ){
                $values = \Profile::getEnumByVariableId($variable_id)->values;
                $values = preg_split("/[, ]+/",$values);
                return view($view)->withMin($min)->withMax($max)->withName($name)->withType($type)->withValues($values);
            }else{
                return view($view)->withName($name)->withType($type)->withMin($min)->withMax($max);
            }

        }


        /**
         * update a variable values
         *
         * @param  string  $
         * @return void
         */
        public function update(Request $request)
        {
            $name = $request->get('name');
            $var_id =   \Profile::getVariableByName($name)->id;

            $user_id = $this->current_user->id;

            $values = $request->get(0);
            $i=1;
            while($value = $request->get($i++)){
                $values .= ",".$value;
            }

            \Profile::updateValue($user_id,$var_id,$values);

            return Redirect::route('profile');

        }


        /**
         * delete a value from profile
         *
         * @param  integer  $variable_id
         * @return boolean
         */
        public function delete(Request $request)
        {
            $variable_id = $request['variable_id'];
            \Profile::deleteValue($this->current_user->id, $variable_id);
            return Redirect::back();
        }


        /**
         * show all undefined variables
         *
         * @param  string  $
         * @return view
         */
        public function getUndefinedVariables()
        {
            $variables = \Profile::getUndefinedVariables($this->current_user->id);
            return view('profile.undefinedVariables')->with('variables', $variables);
        }


}
