<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\JobRequest;
use App\Http\Requests\ApplicationRequest;
use Entrust;
use Auth;
use App\Classes\Helper;
use App\Job;
use App\Location;
use App\Application;
use Activity;
use Config;
use File;
use DB;

Class JobController extends Controller{

	protected $form = 'job-form';

	public function index(Job $job){
    
    	$child_locations = Helper::childLocation(Auth::user()->location_id,1);

		if(!Entrust::can('manage_job'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$query = $job->whereNotNull('id');

		if(!Entrust::can('manage_all_job'))
			$query->whereIn('location_id',$child_locations);

		$jobs = $query->get();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
        		trans('messages.Location'),
        		trans('messages.Number of Posts'),
        		trans('messages.Description'),
        		trans('messages.Date Posted'),
        		trans('messages.Applications'),
        		trans('messages.Status')
        		);

        $col_heads = Helper::putCustomHeads($this->form, $col_heads);
        $col_ids = Helper::getCustomColId($this->form);
        $values = Helper::fetchCustomValues($this->form);

        foreach($jobs as $job){
        	$count = Application::where('job_id','=',$job->id)->count();
			
			$Option = "<a href='/job/$job->id' class='btn btn-default btn-xs' data-toggle='tooltip' title='View'> <i class='fa fa-share'></i></a> ";
			
			if(Auth::user()->id == $job->user_id || Entrust::can('manage_all_job'))
			$Option .= "<a href='/job/$job->id/edit' class='btn btn-default btn-xs' data-toggle='tooltip' title='Edit'> <i class='fa fa-edit'></i></a> ".delete_form(['job.destroy',$job->id]);
			
			$cols = array('<div class="btn-group btn-group-xs">'.
					$Option.'</div>',
					$job->Location->location,
					$job->numbers,
					$job->job_description,
					Helper::showDate($job->created_at),
					$count,
					($job->status == 'open') ? '<span class="label label-success">Open</span>' : '<span class="label label-danger">Closed</span>'
					);	
			$id = $job->id;

			foreach($col_ids as $col_id)
				array_push($cols,isset($values[$id][$col_id]) ? $values[$id][$col_id] : '');
        	$col_data[] = $cols;
        }

        Helper::writeResult($col_data);

        $data = ['col_heads' => $col_heads];

		return view('job.index',$data);
	}

	public function show(Job $job){

		if(!Entrust::can('view_job'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);

		if(!Entrust::can('manage_all_job') && !in_array($job->location_id, $child_locations))
			return redirect('/dashboard')->withErrors(config('constants.NA'));


		$applications = Application::where('job_id','=',$job->id)
			->get();

		return view('job.show',compact('job','applications'));
	}

	public function applicationDetail($id){

		if(!Entrust::can('view_job_application'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$application = Application::find($id);

		if(!$application)
			return redirect('/job')->withErrors(config('constants.INVALID_LINK'));

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);

		if(!Entrust::can('manage_all_job') && !in_array($application->Job->location_id, $child_locations))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$custom_values = Helper::getCustomFieldValues('job-application-form',$id);
		return view('job.application_detail',compact('application','custom_values'));
	}

	public function updateApplicationStatus($id,Request $request){

		if(!Entrust::can('edit_job_application'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$application = Application::find($id);

		if(!$application)
			return redirect('/job')->withErrors(config('constants.INVALID_LINK'));

		$application->status = $request->input('status');
		$application->save();

		return redirect()->back()->withSuccess(config('constants.UPDATED'));
	}

	public function apply(){

		if(Auth::check() && !Entrust::can('apply_job'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$jobs = Job::where('status','=','open')->get();
		$job_lists = Job::where('status','=','open')->lists('job_title','id')->all();
		
		return view('job.apply',compact('jobs','job_lists'));
	}

	public function saveApplication(ApplicationRequest $request){

		if(Auth::check() && !Entrust::can('apply_job'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$job = Job::find($request->input('job_id'));

		if(!$job)
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));

		$filename = uniqid();
		$job_application = new Application;
	    $data = $request->all();
	    if ($request->hasFile('resume')) {
	 		$extension = $request->file('resume')->getClientOriginalExtension();
	 		$file = $request->file('resume')->move('uploads/resume/', $filename.".".$extension);
	 		$data['resume'] = $filename.".".$extension;
		}

		if(Auth::check()){
			$data['user_id'] = Auth::user()->id;
			$data['name'] = Auth::user()->first_name." ".Auth::user()->last_name;
			$data['email'] = Auth::user()->email;
			$data['contact_number'] = Auth::user()->Profile->contact_number;
			$data['address'] =  Auth::user()->Profile->present_address;
		}
	    $job_application->fill($data);
	    $job_application->status = 'unread';
	    $job_application->save();
		Helper::storeCustomField('job-application-form',$job_application->id, $data);

	    return redirect()->back()->withSuccess('You have applied for this job. ');
	}

	public function create(){

		if(!Entrust::can('create_job'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$child_locations = Helper::childLocation(Auth::user()->location_id,1);

	    $query = Location::whereNotNull('locations.id');

	    if(!Entrust::can('manage_all_job'))
	        $query->whereIn('locations.id',$child_locations);

	    $locations = $query->join('clients','clients.id','=','locations.client_id')
	        ->select(DB::raw('CONCAT(location, " (", client_name, ")") AS full_location,locations.id AS location_id'))
	        ->lists('full_location','location_id')->all();

		return view('job.create',compact('locations'));
	}

	public function edit(Job $job){

		if(!Entrust::can('edit_job') || (Auth::user()->id != $job->user_id && !Entrust::can('manage_all_job')))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$custom_field_values = Helper::getCustomFieldValues($this->form,$job->id);
		
		$child_locations = Helper::childLocation(Auth::user()->location_id,1);

	    $query = Location::whereNotNull('locations.id');

	    if(!Entrust::can('manage_all_job'))
	        $query->whereIn('locations.id',$child_locations);

	    $locations = $query->join('clients','clients.id','=','locations.client_id')
	        ->select(DB::raw('CONCAT(location, " (", client_name, ")") AS full_location,locations.id AS location_id'))
	        ->lists('full_location','location_id')->all();

		return view('job.edit',compact('locations','job','custom_field_values'));
	}

	public function store(JobRequest $request, Job $job){	

		if(!Entrust::can('create_job'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
		$data = $request->all();
		$data['user_id'] = Auth::user()->id;
		$job->fill($data)->save();

		Helper::storeCustomField($this->form,$job->id, $data);
		$activity = 'New Job posted';
		Activity::log($activity);

		return redirect()->back()->withSuccess(config('constants.ADDED'));		
	}

	public function update(JobRequest $request, Job $job){

		if(!Entrust::can('edit_job') || (Auth::user()->id != $job->user_id && !Entrust::can('manage_all_job')))
			return redirect('/dashboard')->withErrors(config('constants.NA'));
		
		$data = $request->all();
		$job->fill($data)->save();
		Helper::updateCustomField($this->form,$job->id, $data);
		$activity = 'Job "'.$request->input('job_title').'" updated';
		Activity::log($activity);
		return redirect('/job')->withSuccess(config('constants.UPDATED'));
	}
	
	public function destroy(Job $job){
		if(!Entrust::can('delete_job'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        if(!Helper::getMode())
            return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		Helper::deleteCustomField($this->form, $job->id);
		$activity = 'Job "'.$job->job_title.'" deleted';
		Activity::log($activity);
        $job->delete();
        return redirect('/job')->withSuccess(config('constants.DELETED'));
	}

	public function deleteApplication($id){

		if(!Entrust::can('delete_job_application'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		$application = Application::find($id);
		if(!$application)
			return redirect()->back()->withErrors(config('constants.INVALID_LINK'));

		Helper::deleteCustomField('job-application-form', $application->id);
		$resume = $application->resume;

		File::delete('uploads/resume/'.$resume);
		$application->delete();

		return redirect()->back()->withSuccess(config('constants.DELETED'));
	}
}
?>