<?php
namespace App\Http\Controllers;
use DB;
use App\Clock;
use Auth;
use Activity;
use Entrust;
use Config;
use Maatwebsite\Excel\Facades\Excel;
use File;
use App\Holiday;
use App\User;
use App\Classes\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use App\Http\Requests\AttendanceMonthlyRequest;
use App\Http\Requests\AttendanceUploadRequest;

Class ClockController extends Controller{

	public function index(){
	}

	public function show(){
	}

	public function in($token){
		$date = date('Y-m-d');
    
    if(!Helper::verifyCsrf($token))
      return redirect('/dashboard')->withErrors(config('constants.CSRF'));

		$clocks = Clock::where('user_id','=',Auth::user()->id)
			->where('date','=',$date)->count();

		if($clocks)
			return redirect('/dashboard')->withErrors('You have already clocked in today. ');

		$clock = new Clock;
		$clock->date = $date;
		$clock->clock_in = date('Y-m-d H:i:s');
		$clock->user_id = Auth::user()->id;
		$clock->save();
		Activity::log('Clocked in');
		return redirect('/dashboard')->withSuccess('You have successfully clocked in. ');
	}

	public function out($token){
		$date = date('Y-m-d');

    if(!Helper::verifyCsrf($token))
      return redirect('/dashboard')->withErrors(config('constants.CSRF'));

		$clock = Clock::where('user_id','=',AutH::user()->id)
			->where('date','=',$date)
			->where('clock_out','=',null)
			->first();

		if(!$clock)
			return redirect('/dashboard')->withErrors('Either you have not clocked in or you have already clocked out today. ');

		$clock->clock_out = date('Y-m-d H:i:s');
		$clock->save();

		Activity::log('Clocked out');
		return redirect('/dashboard')->withSuccess('You have successfully clocked out. ');
	}

	public function attendance(Request $request){

		if(!Entrust::can('daily_attendance'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$date = $request->input('date');
		$date = isset($date) ? $date : date('Y-m-d');

		if(Entrust::can('manage_everyone_attendance'))
			$clocks = Clock::where('date','=',$date)->get();
		else {
			
			if(Entrust::can('manage_subordinate_attendance')){
				$child_locations = Helper::childLocation(Auth::user()->location_id,1);
				$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
				array_push($child_users, Auth::user()->id);
			} else
				$child_users = array(Auth::user()->id);
			$clocks = Clock::where('date','=',$date)->whereIn('user_id',$child_users)->get();
		}

		$page_title = "Attendance for ".Helper::showDate($date);

        $cols=array();
        $cols_summary=array();
        $col_heads = array(
        		'Employee Name',
        		'Location',
        		'Client',
        		'Clock in',
        		'Clock out',
        		'Late',
        		'Early Leaving',
        		'Overtime',
        		'Total Work',
        		'Status');
        $clocked_user = array();
        $in_time = $date.' '.config('config.in_time');
        $out_time = $date.' '.config('config.out_time');

        $holiday = Holiday::where('date','=',$date)->count();

        $total_late = 0;
        $total_early = 0;
        $total_overtime = 0;
        $total_working = 0;
		
        $users = User::all();

        if($holiday){
        	$attendance = 'H';
        	$attendance_label = '<span class="badge badge-info">Holiday</span>';
        }
        elseif(!$holiday && $date < date('Y-m-d')){
        	$attendance = 'A';
        	$attendance_label = '<span class="badge badge-danger">Absent</span>';
        }
        else{
        	$attendance = '';
        	$attendance_label = '';
        }

        foreach($users as $user){
        	$name = $user->first_name." ".$user->last_name;
        	$location = $user->Location->location;
        	$client = $user->Location->Client->client_name;
			if(Entrust::can('manage_everyone_attendance') || 
				(Entrust::can('manage_subordinate_attendance') && in_array($user->id, $child_users)) ||
				Auth::user()->id == $user->id
			){
				$cols[$user->id] = array($name,$location,$client,'','','','','','',$attendance_label);
        		$cols_summary[$user->id] = $attendance;
			}
        }

		foreach($clocks as $clock){
			$clocked_user[] = $clock->user_id;
			$user = $clock->User;
			$location = $user->Location;
			$client = $location->Client;

			$late = (strtotime($in_time) < strtotime($clock->clock_in)) ? round(abs(strtotime($in_time) - strtotime($clock->clock_in)) / 60,2) : '';
			$early = ($clock->clock_out != null && strtotime($clock->clock_out) < strtotime($out_time)) ? round(abs(strtotime($out_time) - strtotime($clock->clock_out)) / 60,2) : '';
			$overtime = ($clock->clock_out != null && strtotime($clock->clock_out) > strtotime($out_time)) ? round(abs(strtotime($out_time) - strtotime($clock->clock_out)) / 60,2) : '';
			$working = ($clock->clock_out != null) ? round(abs(strtotime($clock->clock_out) - strtotime($clock->clock_in)) / 60,2) : '';
			$total = ($clock->clock_out != null) ? round(abs(strtotime($clock->clock_out) - strtotime($clock->clock_in)) / 60,2) : '';
			
			$total_late += $late;
			$total_early += $early;
			$total_overtime += $overtime;
			$total_working += $working;

			$cols[$clock->user_id] = array(
					$user->first_name." ".$user->last_name,
					$location->location,
					$client->client_name,
					Helper::showTime($clock->clock_in),
					($clock->clock_out != null) ? Helper::showTime($clock->clock_out) : 'Not Yet',
					$late,
					$early,
					$overtime,
					$total,
					'<span class="badge badge-success">Present</span>'
					);	
			$cols_summary[$user->id] = 'P';
		}

		$col_data = array_values($cols);
        Helper::writeResult($col_data);

        $data = ['col_heads' => $col_heads,
        	'date' => $date,
        	'cols_summary' => array_count_values($cols_summary),
        	'page_title' => $page_title
        	];

		return view('employee.attendance',$data);
	}

	public function attendanceMonthly(){

        $query = DB::table('users');

		if(Entrust::can('manage_everyone_attendance')){}
		elseif(Entrust::can('manage_subordinate_attendance')){
			$child_locations = Helper::childLocation(Auth::user()->location_id,1);
			$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
			array_push($child_users, Auth::user()->id);
        	$query->whereIn('users.id',$child_users);
		} else {
			$query->where('users.id','=',Auth::user()->id);
		}

        $users = $query->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $col_data=array();
        $col_heads = array(
        		'Date',
        		'Clock in',
        		'Clock out',
        		'Late',
        		'Early Leaving',
        		'Total Work');
        Helper::writeResult($col_data);  

		$data = ['users' => $users,
			'col_heads' => $col_heads
        	];

		return view('employee.attendance_monthly',$data);
	}

	public function attendanceMonthlyReport(AttendanceMonthlyRequest $request){

		$user_id = $request->input('user_id');
		$month = $request->input('month');
		$year = $request->input('year');

        $cols=array();
        $cols_summary=array();
        $col_heads = array(
        		'Date',
        		'Clock in',
        		'Clock out',
        		'Late','Early Leaving','Overtime','Total Work','Status');

		$day = $year."-".$month."-1";
		$month_number = date('m',strtotime($day));
		$no_of_days = cal_days_in_month(CAL_GREGORIAN,$month_number,$year);

		$first_day = $year."-".$month_number."-1";
		$last_day = $year."-".$month_number."-".$no_of_days;

		$clocks = Clock::where('user_id','=',$user_id)
			->where('date','>=',$first_day)
			->where('date','<=',$last_day)
			->get();

        $query = DB::table('users');

		if(Entrust::can('manage_everyone_attendance')){}
		elseif(Entrust::can('manage_subordinate_attendance')){
			$child_locations = Helper::childLocation(Auth::user()->location_id,1);
			$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
			array_push($child_users, Auth::user()->id);
        	$query->whereIn('users.id',$child_users);
		} else {
			$query->where('users.id','=',Auth::user()->id);
		}

        $users = $query->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, "(", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $user = User::find($user_id);
        $clocked_user = array();

        for($i = 1; $i <= $no_of_days; $i++){
        	$date = $year."-".$month_number."-".str_pad($i, 2, 0, STR_PAD_LEFT);
        	if($date < date('Y-m-d')){
        		$cols[$date] = array(date('d M Y',strtotime($date)),'','','','','','','<span class="badge badge-danger">Absent</span>');
        		$cols_summary[$date] = 'A';
        	}
        	else{
        		$cols[$date] = array(date('d M Y',strtotime($date)),'','','','','','','');
        		$cols_summary[$date] = '';
        	}
        }

        $holidays = Holiday::where( DB::raw('MONTH(date)'), '=', date('n',strtotime($first_day)) )
            ->where( DB::raw('YEAR(date)'), '=', $year )
            ->orderBy('date','asc')
            ->get();

        foreach($holidays as $holiday){
        	$cols[$holiday->date] = array(date('d M Y',strtotime($holiday->date)),'','','','','','','<span class="badge badge-info">Holiday</span>');
        	$cols_summary[$holiday->date] = 'H';
        }

        $total_late = 0;
        $total_early = 0;
        $total_overtime = 0;
        $total_working = 0;

		foreach($clocks as $clock){
        	$in_time = $clock->date.' '.config('config.in_time');
	        $out_time = $clock->date.' '.config('config.out_time');
			
			$late = (strtotime($in_time) < strtotime($clock->clock_in)) ? round(abs(strtotime($in_time) - strtotime($clock->clock_in)) / 60,2) : '';
	        $early = ($clock->clock_out != null && strtotime($clock->clock_out) < strtotime($out_time)) ? round(abs(strtotime($out_time) - strtotime($clock->clock_out)) / 60,2) : '';
	        $overtime = ($clock->clock_out != null && strtotime($clock->clock_out) > strtotime($out_time)) ? round(abs(strtotime($out_time) - strtotime($clock->clock_out)) / 60,2) : '';
	        $working = ($clock->clock_out != null) ? round(abs(strtotime($clock->clock_out) - strtotime($clock->clock_in)) / 60,2) : '';
	        $cols_summary[$clock->date] = 'P';
	        $cols[$clock->date] = array(
					Helper::showDate($clock->date),
					Helper::showTime($clock->clock_in),
					($clock->clock_out != null) ? Helper::showTime($clock->clock_out) : 'Not Yet',
					$late,
					$early,
					$overtime,
					$working,
					'<span class="badge badge-success">Present</span>'
					);	

			$total_late += $late;
			$total_early += $early;
			$total_working += $working;
			$total_overtime += $overtime;
		}

		$col_data = array_values($cols);

        Helper::writeResult($col_data);    

        $col_foots = array(
        			'',
        			'',
        			'',
        			Helper::convertToHoursMins($total_late,'%01d hr %01d min'),
        			Helper::convertToHoursMins($total_early,'%01d hr %01d min'),
        			Helper::convertToHoursMins($total_overtime,'%01d hr %01d min'),
        			Helper::convertToHoursMins($total_working,'%01d hr %01d min'),
        			''
        		);
		$data = [
			'col_heads'=> $col_heads,
			'user_id' => $user_id,
			'month' => $month,
			'year'=>$year,
			'users' => $users,
			'user' => $user,
        	'col_foots' => $col_foots,
        	'cols_summary' => array_count_values($cols_summary)
			];
		return view('employee.attendance_monthly',$data);
	}

	public function updateAttendance(){
		
		if(!Entrust::can('update_attendance'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

        $query = DB::table('users');

		if(Entrust::can('manage_everyone_attendance')){}
		elseif(Entrust::can('manage_subordinate_attendance')){
			$child_locations = Helper::childLocation(Auth::user()->location_id,1);
			$child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
			//array_push($child_users, Auth::user()->id);
        	$query->whereIn('users.id',$child_users);
		} else {
			$query->where('users.id','=',Auth::user()->id);
		}

        $users = $query->join('locations','locations.id','=','users.location_id')
        	->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, "(", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $assets = ['datetimepicker'];
        return view('employee.update_attendance',compact('users','assets'));
	}

	public function uploadAttendance(AttendanceUploadRequest $request){
		
		if(!Entrust::can('upload_attendance'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$filename = uniqid();
		$extension = $request->file('file')->getClientOriginalExtension();
	 	$file = $request->file('file')->move('uploads/attendance',$filename.".".$extension);
	 	$filename_extension = 'uploads/attendance/'.$filename.'.'.$extension;
		$xls_datas = Excel::load($filename_extension, function($reader) { })->toArray();
		if(count($xls_datas) > 0)
		{
			$employees = User::join('profile','profile.user_id','=','users.id')
				->select(DB::raw('users.id AS user_id,employee_code'))
				->lists('user_id','employee_code')->all();

		    $data = array();
		    foreach($xls_datas as $xls_data)
		    {
		      $employee_code = $xls_data['employee_code'];
		      $user_id = (isset($employees[$employee_code])) ? $employees[$employee_code] : NULL;
		      $date = date('Y-m-d',strtotime($xls_data['date']));
		      $clock_in = date('H:i',strtotime($xls_data['clock_in']));
		      $clock_in = date('Y-m-d H:i:s',strtotime($date.' '.$clock_in));
		      $clock_out = date('H:i',strtotime($xls_data['clock_out']));
		      $clock_out = date('Y-m-d H:i:s',strtotime($date.' '.$clock_out));
		      
		      $clock = Clock::where('user_id','=',$user_id)
		      	->where('date','=',$date)
		      	->lists('id');
		      if($user_id != null && !count($clock) && strtotime($clock_in) < strtotime($clock_out))
		      $data[] = array(
		      		'user_id' => $user_id,
		      		'date' => $date,
		      		'clock_in' => $clock_in,
		      		'clock_out' => $clock_out,
		      		'created_at' => date('Y-m-d H:i:s'),
		      		'updated_at' => date('Y-m-d H:i:s')
		      		);
		    }
		    if(count($data))
		    	Clock::insert($data);
		}
		if (File::exists($filename_extension))
			File::delete($filename_extension);

		return redirect('/dashboard')->withSuccess(count($data).' attendance uploaded successfully out of '.count($xls_datas).' attendance.');
	}

	public function updateStaffAttendance(AttendanceRequest $request){
		
		if(!Entrust::can('update_attendance'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$clock = Clock::where('user_id','=',$request->input('user_id'))
			->where('date','=',$request->input('date'))
			->first();

		if(!$clock){
			$clock = new Clock;
			$clock->user_id = $request->input('user_id');
		}

		if($request->input('clock_in') == '' && $request->input('clock_out') == '')
			return redirect()->back()->withInput()->withErrors('Please enter clock in or clock out. ');

		if($request->input('clock_in') == '' && $clock->clock_in == '' && $request->input('clock_out') != '')
			return redirect()->back()->withInput()->withErrors('This user has not clocked in, Please clock in first then clock out.');

		if($request->input('clock_in') == '')
			$clock_in = strtotime($clock->clock_in);
		else
			$clock_in = strtotime($request->input('date')." ".$request->input('clock_in'));

		if($request->input('clock_out') == '')
			$clock_out = isset($clock->clock_out) ? strtotime($clock->clock_out) : NULL;
		else
			$clock_out = strtotime($request->input('date')." ".$request->input('clock_out'));

		if($clock_out != NULL && $clock_in > $clock_out)
			return redirect()->back()->withInput()->withErrors('In time cannot be greater than out time. ');

		$clock->date = $request->input('date');
		$clock->clock_in = date('Y-m-d H:i:s',$clock_in);
		$clock->clock_out = isset($clock_out) ? date('Y-m-d H:i:s',$clock_out) : NULL;
		$clock->save();

		return redirect()->back()->withSuccess(config('constants.SAVED'));

	}
}
?>