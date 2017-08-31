<?php
namespace App\Http\Controllers;
use DB;
use Entrust;
use Config;
use Activity;
use App\Classes\Helper;
use App\Task;
use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;

Class TaskController extends Controller{

	protected $form = 'task-form';

	public function index(Task $task){

		if(!Entrust::can('manage_task'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(Entrust::can('manage_everyone_task'))
			$tasks = $task->get();
		elseif(Entrust::can('manage_subordinate_task')) {

			$child_locations = Helper::childLocation(Auth::user()->location_id,1);
			$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
			array_push($child_users, Auth::user()->id);

			$tasks = Task::whereHas('user', function($q) use($child_users){
			    $q->whereIn('user_id',$child_users);
			})->get();
		} else 
			$tasks = Task::whereHas('user', function($q){
			    $q->where('user_id','=',Auth::user()->id);
			})->get();

        $col_data=array();
        $cols = array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Title'),
        		trans('messages.Assigned to'),
        		trans('messages.Start Date'),
        		trans('messages.Due Date'),
        		trans('messages.Hours'),
        		trans('messages.Progress')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);

        $values = Helper::fetchCustomValues($this->form);

       	$visible = 0;
        foreach($tasks as $task){

        	$user_name = "<ol class='nl'>";
        	foreach($task->User as $user){

        		if($user->id == Auth::user()->id)
        			$visible = 1;
        		
        		$location = $user->Location;
        		$location_name = $location->location;
        		$client = $location->Client;
        		$client_name = $client->client_name;
			    $user_name .= "<li>$user->first_name $user->last_name ($location_name in $client_name)</li>";
			}
        	$user_name .= "</ol>";

        	if($task->task_username == Auth::user()->username)
        		$visible = 1;

			$linkToEdit = '<a href="task/'.$task->id.'/edit" class="btn btn-default btn-xs" data-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a>';
			$linkToDelete = delete_form(['task.destroy',$task->id]);
			$linkToView = '<a href="task/'.$task->id.'" class="btn btn-default btn-xs" data-toggle="tooltip" title="View"> <i class="fa fa-share"></i></a>';
			
			$Option = $linkToView;
			if($task->task_username == Auth::user()->username || Entrust::hasRole('admin'))
				$Option .= " $linkToEdit $linkToDelete";
			
			// if($visible == 1)
			$cols = array('<div class="btn-group btn-group-xs">'.$Option.'</div>', 
				$task->task_title,
				$user_name,
				Helper::showDate($task->start_date),
				Helper::showDate($task->due_date),
				isset($task->hours)? $task->hours.' Hr' : 'NA',
				$task->task_progress.' %'
				);	
			$id = $task->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');

        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

		return view('task.index',compact('col_heads'));
	}

	public function updateTaskProgress(Request $request){

		if(!Entrust::can('update_progress_task'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$id = $request->input('task_id');
		$task_progress = $request->input('task_progress');
		
		$task = Task::find($id);

		if(!$task)
			return redirect('/task')->withErrors(config('constants.INVALID_LINK'));

		$task->id = $id;
		$task->task_progress = $task_progress;
		$task->save();
		$activity = 'Updated a task progress';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.SAVED'));
	}

	public function show(Task $task){

		if(Entrust::can('manage_subordinate_task')){

			$child_locations = Helper::childLocation(Auth::user()->location_id,1);
			$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
			array_push($child_users, Auth::user()->id);

			$task = Task::where('id','=',$task->id)->whereHas('user', function($q) use ($child_users){
			    $q->whereIn('user_id',$child_users);
			})->first();
		}
		else
			$task =  Task::where('id','=',$task->id)->first();

		if(!Entrust::can('view_task'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(!$task)
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$note = DB::table('notes')
			->where('task_id','=',$task->id)
			->where('note_username','=',Auth::user()->username)
			->join('tasks','tasks.id','=','notes.task_id')
			->first();

		$comments = DB::table('comments')
			->where('task_id','=',$task->id)
			->join('tasks','tasks.id','=','comments.task_id')
			->join('users','users.username','=','comments.comment_username')
			->select(DB::raw('users.username,comments.id,users.id as user_id,comment,comments.created_at,first_name,last_name'))
			->get();

		$attachments = DB::table('attachments')
			->where('task_id','=',$task->id)
			->join('tasks','tasks.id','=','attachments.task_id')
			->select(DB::raw('attachment_username,attachments.id,attachment_title,attachment_description,attachments.created_at,file'))
			->get();

		$data = [
			'task' => $task,
			'note' => $note,
			'comments' => $comments,
			'attachments' => $attachments
			];

		return view('task.show',$data);
	}

	public function create(){

		if(!Entrust::can('create_task'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);

        $query = DB::table('users');

        if(!Entrust::can('manage_everyone_task'))
        	$query->whereIn('users.location_id',$child_locations)
        	->orWhere(function ($qry) {
        		$qry->where('users.id','=',Auth::user()->id);
        	});

        $users = $query->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

		return view('task.create',compact('users'));
	}

	public function edit(Task $task){

		if(!Entrust::can('edit_task'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if($task->task_username != Auth::user()->username && !Entrust::hasRole('admin'))
			return redirect('/task')->withErrors(config('constants.INVALID_LINK'));

		$selected_user = array();

		foreach($task->User as $user){
			$selected_user[] = $user->id;
		}

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);

        $query = DB::table('users');

        if(!Entrust::can('manage_everyone_task'))
        	$query->whereIn('users.location_id',$child_locations)
        	->orWhere(function ($qry) {
        		$qry->where('users.id','=',Auth::user()->id);
        	});

        $users = $query->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

		$custom_field_values = Helper::getCustomFieldValues($this->form,$task->id);
		return view('task.edit',compact('users','task','selected_user','custom_field_values'));
	}

	public function store(TaskRequest $request, Task $task){

		if(!Entrust::can('create_task'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));
	
		$data = $request->all();
	    $task->fill($data);
	    $task->task_username = Auth::user()->username;
		$task->save();
	    $task->user()->sync($request->input('user_id'));
		Helper::storeCustomField($this->form,$task->id, $data);

		$activity = 'Created a task';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.SAVED'));	
	}

	public function update(TaskRequest $request, Task $task){

		if(!Entrust::can('edit_task'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$data = $request->all();
		$task->fill($data);
		$task->save();
	    $task->user()->sync($request->input('user_id'));
		Helper::updateCustomField($this->form,$task->id, $data);
		$activity = 'Updated a task';
		Activity::log($activity);
		return redirect('/task')->withSuccess(config('constants.UPDATED'));
	}

	public function destroy(Task $task){
		if(!Entrust::can('delete_task'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if($task->task_username != Auth::user()->username && !Entrust::hasRole('admin'))
			return redirect('/task')->withErrors(config('constants.INVALID_LINK'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $task->id);
		$activity = 'Task deleted';
		Activity::log($activity);
		$task->delete();
        return redirect('/task')->withSuccess(config('constants.DELETED'));
	}
}
?>