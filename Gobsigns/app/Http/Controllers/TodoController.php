<?php
namespace App\Http\Controllers;
use DB;
use Config;
use Entrust;
use App\Todo;
use App\Classes\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Activity;
use Auth;

Class TodoController extends Controller{

	protected $form = 'todo-form';

	public function index(){
		return view('todo.create');
	}

	public function show(Todo $todo){
		return view('todo.edit');
	}

	public function create(){
	}

	public function edit(Todo $todo){
		return view('todo.edit',compact('todo'));
	}

	public function store(TodoRequest $request, Todo $todo){	
		$data = $request->all();
	    $todo->fill($data);
	    $todo->user_id = Auth::user()->id;
		$todo->save();

		$activity = 'Added an to do list';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.SAVED'));	
	}

	public function update(TodoRequest $request, Todo $todo){
		
		$data = $request->all();
		$todo->fill($data)->save();

		$activity = 'To do updated';
		Activity::log($activity);
		
		return redirect('/dashboard')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Todo $todo){
        $todo->delete();

		$activity = 'Deleted a To do';
		Activity::log($activity);

        return redirect('/dashboard')->withSuccess(config('constants.DELETED'));
	}
}
?>