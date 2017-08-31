<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\PayrollRequest;
use DB;
use Entrust;
use Config;
use Auth;
use PDF;
use App\User;
use App\PayrollSlip;
use App\SalaryType;
use App\Salary;
use App\Clock;
use App\Holiday;
use App\Payroll;
use App\Classes\Helper;

Class PayrollController extends Controller{

	public function index(){

		if(!Entrust::can('manage_payroll'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

    	$query = PayrollSlip::where('id','!=','');

    	if(Entrust::can('manage_everyone_payroll')){}
      elseif(Entrust::can('manage_subordinate_payroll')){
        $child_locations = Helper::childLocation(Auth::user()->location_id,1);
        $child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
        array_push($child_users, Auth::user()->id);
        $query->whereIn('user_id',$child_users);
      } else {
        $query->where('user_id','=',Auth::user()->id);
      }

    	$payroll_slips = $query->get();

        $token = csrf_token();

        $col_data=array();
        $col_heads = array(
        		trans('messages.Option'),
            trans('messages.Name'),
        		trans('messages.Client'),
        		trans('messages.Location'),
        		trans('messages.Month & Year')
        		);

        foreach($payroll_slips as $payroll_slip){
			$linkToPrint = "<a href='/payroll/generate/print/$payroll_slip->id' class='btn btn-default btn-xs' data-toggle='tooltip' title='Print'> <i class='fa fa-print'></i></a>";
			$linkToPDF = "<a href='/payroll/generate/pdf/$payroll_slip->id' class='btn btn-default btn-xs' data-toggle='tooltip' title='Generate PDF'> <i class='fa fa-file'></i></a>";
			$Option = '<div class="btn-group btn-group-xs">'.$linkToPrint.$linkToPDF.'</div>';
			$col_data[] = array(
          $Option,
					$payroll_slip->User->first_name." ".$payroll_slip->User->last_name,
					$payroll_slip->User->Location->Client->client_name,
					$payroll_slip->User->Location->location,
					$payroll_slip->month." ".$payroll_slip->year
		      );	
        }

        Helper::writeResult($col_data);

        $data = ['col_heads' => $col_heads];

		return view('payroll.index',$data);
	}

	public function show(){
	}

  public function myPayroll(Request $request){

    $query = DB::table('users');
    $user_id = $request->input('user_id') ? : Auth::user()->id;

    if(Entrust::can('manage_everyone_payroll')){}
    elseif(Entrust::can('manage_subordinate_payroll')){
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

    $slips = PayrollSlip::where('user_id','=',$user_id)->get();

    $salary_types = SalaryType::all();

    $col_heads = [
    trans('messages.Option'),
    trans('messages.Payslip No'),
    trans('messages.Month & Year'),
    trans('messages.Generated On')];
    foreach($salary_types as $salary_type){
      array_push($col_heads,$salary_type->salary_head);
      $sum_amount[$salary_type->id] = 0;
    }

    array_push($col_heads,trans('messages.Total'));
    $cols = array();
    $sum_total = 0;
    foreach($slips as $slip){
      $linkToPrint = "<a href='/payroll/generate/print/$slip->id' target='_blank' class='btn btn-default btn-xs' data-toggle='tooltip' title='Print'> <i class='fa fa-print'></i></a>";
      $linkToPDF = "<a href='/payroll/generate/pdf/$slip->id' target='_blank' class='btn btn-default btn-xs' data-toggle='tooltip' title='PDF'> <i class='fa fa-file'></i></a>";
      $Option = '<div class="btn-group btn-group-xs">'.$linkToPrint.$linkToPDF.'</div>';

        $amount = array();
        $total = 0;

        $month_year = $slip->year.'-'.$slip->month.'-01';

        foreach($salary_types as $salary_type)
          $amount[$salary_type->id] = 0;

        foreach($slip->Payroll as $payroll){
          $amount[$payroll->salary_type_id] = round($payroll->amount,2);
          $sum_amount[$payroll->salary_type_id] += round($payroll->amount,2);
        }

        foreach($salary_types as $salary_type){
          if($salary_type->salary_type == "earning")
            $total += $amount[$salary_type->id];
          else
            $total -= $amount[$salary_type->id];
        }
            
        $col = [$Option,$slip->id,date('M Y',strtotime($month_year)), date('d M Y',strtotime($slip->created_at))];
        foreach($amount as $value)
          array_push($col,$value);
          array_push($col,$total);

        $sum_total += $total;

        $cols[] = $col;

        unset($amount);
    }

    $col_foots = ['-','-','-','-'];
    foreach($sum_amount as $sum)
      array_push($col_foots, $sum);
      array_push($col_foots, $sum_total);
    
    $col_data = array_values($cols);
    Helper::writeResult($col_data);   

    return view('payroll.my_payroll',compact('users','user_id','cols','col_heads','col_foots'));
  }

	public function create(Request $request){

		if(!Entrust::can('create_payroll'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

	$month = $request->input('month') ? $request->input('month') : lcfirst(date('F'));
	$year = $request->input('year') ? $request->input('year') : date('Y');
	$user_id = $request->input('user_id') ? $request->input('user_id') : Auth::user()->id;
	$user = User::find($user_id);
	$summary = array();

    $query = DB::table('users');

    if(Entrust::can('manage_everyone_payroll')){}
    elseif(Entrust::can('manage_subordinate_payroll')){
      $child_locations = Helper::childLocation(Auth::user()->location_id,1);
      $child_users = User::whereIn('location_id',$child_locations)->lists('id')->all();
      //array_push($child_users, Auth::user()->id);
      $query->whereIn('users.id',$child_users);
    } else {
      $query->where('users.id','=',Auth::user()->id);
    }

    $users = $query->join('locations','locations.id','=','users.location_id')
    	->join('clients','clients.id','=','locations.client_id')
        ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
        ->lists('full_name','user_id');

	$day = $year."-".$month."-1";
	$month_number = date('m',strtotime($day));
	$no_of_days = cal_days_in_month(CAL_GREGORIAN,$month_number,$year);

	$first_day = $year."-".$month_number."-1";
	$last_day = $year."-".$month_number."-".$no_of_days;

	$clocks = Clock::where('user_id','=',$user_id)
		->where('date','>=',$first_day)
		->where('date','<=',$last_day)
		->get();

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
        
		$total_late += $late;
		$total_early += $early;
		$total_working += $working;
		$total_overtime += $overtime;
	}

	$summary['total_late'] = Helper::convertToHoursMins($total_late,'%01d hr %01d min');
	$summary['total_early'] = Helper::convertToHoursMins($total_early,'%01d hr %01d min');
	$summary['total_working'] = Helper::convertToHoursMins($total_working,'%01d hr %01d min');
	$summary['total_overtime'] = Helper::convertToHoursMins($total_overtime,'%01d hr %01d min');	

  	$att_summary['A'] = 0;
  	$att_summary['H'] = 0;
  	$att_summary['P'] = 0;

  	$cols_summary = array_count_values($cols_summary);
  	
  	$att_summary['A'] = array_key_exists('A', $cols_summary) ? $cols_summary['A'] : 0;
  	$att_summary['H'] = array_key_exists('H', $cols_summary) ? $cols_summary['H'] : 0;
  	$att_summary['P'] = array_key_exists('P', $cols_summary) ? $cols_summary['P'] : 0;
  	$att_summary['W'] = $att_summary['H'] + $att_summary['P'];

    $payroll_slip = PayrollSlip::where('user_id','=',$user_id)
		->where('month','=',$month_number)
		->where('year','=',$year)
		->first();

    $payroll = Payroll::join('payroll_slip','payroll_slip.id','=','payroll.payroll_slip_id')
    	->where('payroll_slip_id','=',isset($payroll_slip->id) ? $payroll_slip->id : '')
        ->lists('amount','salary_type_id')->all();

    $earning_salary_types = SalaryType::where('salary_type','=','earning')->get();
    $deduction_salary_types = SalaryType::where('salary_type','=','deduction')->get();
    $salary = Salary::where('user_id','=',$user_id)
    	->join('salary_types','salary_types.id','=','salary.salary_type_id')
        ->get();

	$first_day = $year."-".$month_number."-1";
	$last_day = $year."-".$month_number."-".cal_days_in_month(CAL_GREGORIAN,$month_number,$year);
  $salary_fraction = $att_summary['W'] / $no_of_days;
	
  	$data = [
  		'users' => $users,
  		'user' => $user,
  		'month' => $month,
  		'year' => $year,
  		'user_id' => $user_id,
  		'earning_salary_types' => $earning_salary_types,
  		'deduction_salary_types' => $deduction_salary_types,
  		'salary' => $salary,
  		'payroll' => $payroll,
  		'payroll_slip' => $payroll_slip,
  		'summary' => $summary,
  		'att_summary' => $att_summary,
      'salary_fraction' => $salary_fraction
  		];

	return view('payroll.create',$data);
	}

	public function generate($action = 'print' , $payroll_slip_id){

		if(!Entrust::can('generate_payroll'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$payroll_slip = PayrollSlip::find($payroll_slip_id);

		if(!$payroll_slip)
			return redirect('/payroll')->withErrors(config('constants.INVALID_LINK'));

		if(!Entrust::hasRole('admin') && $payroll_slip->user_id != Auth::user()->id)
			return redirect('/payroll')->withErrors(config('constants.INVALID_LINK'));

		$user = User::find($payroll_slip->user_id);
		$day = $payroll_slip->year."-".$payroll_slip->month."-1";
		$month_number = date('m',strtotime($day));

    	$payroll = Payroll::join('payroll_slip','payroll_slip.id','=','payroll.payroll_slip_id')
    		->where('payroll_slip_id','=',$payroll_slip_id)
        	->lists('amount','salary_type_id')->all();

    	$earning_salary_types = SalaryType::where('salary_type','=','earning')->get();
   	 	$deduction_salary_types = SalaryType::where('salary_type','=','deduction')->get();
    	
   	 	$data = [
   	 		'user' => $user,
   	 		'month_number' => $month_number,
   	 		'payroll' => $payroll,
   	 		'earning_salary_types' => $earning_salary_types,
   	 		'deduction_salary_types' => $deduction_salary_types,
   	 		'payroll_slip' => $payroll_slip,
   	 		'total_earning' => 0,
   	 		'total_deduction' => 0
   	 		];

   	 	if($action == 'pdf'){
	   	 	$pdf = PDF::loadView('payroll.pdf', $data);
			return $pdf->download('payslip.pdf');
   	 	}	
    	return view('payroll.pdf',$data);
	}

	public function store(PayrollRequest $request){

		if(!Entrust::can('create_payroll'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$salary_types = SalaryType::all();

		$day = $request->input('year')."-".$request->input('month')."-1";
		$month = date('m',strtotime($day));

		$payroll_slip = PayrollSlip::firstOrCreate(array(
				'user_id' => $request->input('user_id'), 
				'month' => $month,
				'year' => $request->input('year')
				));
		$payroll_slip->user_id = $request->input('user_id');
		$payroll_slip->month = $month;
    $payroll_slip->employee_contribution = $request->input('employee_contribution');
    $payroll_slip->employer_contribution = $request->input('employer_contribution');
    $payroll_slip->date_of_contribution = $request->input('date_of_contribution') ? : null;
		$payroll_slip->year = $request->input('year');
		$payroll_slip->save();

		foreach($salary_types as $salary_type){
			$salary = Payroll::firstOrCreate(array(
				'payroll_slip_id' => $payroll_slip->id,
				'salary_type_id' => $salary_type->id
				));
			$salary->payroll_slip_id = $payroll_slip->id;
			$salary->salary_type_id = $salary_type->id;
			$salary->amount = $request->input($salary_type->id);
			$salary->save();
		}

		return redirect()->back()->withSuccess(config('constants.SAVED'));
	}

  public function allContribution(Request $request){

    $user_id = $request->input('user_id') ? : '';
    $month = $request->input('month') ? : '';
    $year = $request->input('year') ? : '';

    $day = ($year != '') ? $year : date('Y') ."-".$month."-1";
    $month_number = date('m',strtotime($day));

    $col_heads = array();
    $col_data = array();

    $query = DB::table('users');

    if(Entrust::can('manage_everyone_payroll')){}
    elseif(Entrust::can('manage_subordinate_payroll')){
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

    $payroll_query = PayrollSlip::where('id','!=','');

    if($month != '')
      $payroll_query->where('month','=',$month_number);

    if($year != '')
      $payroll_query->where('year','=',$year);

    $payroll_query->where('user_id','=',($user_id) ? : Auth::user()->id);

    $slips = $payroll_query->get();

    $col_heads = array(
        trans('messages.Month & Year'),
        trans('messages.Staff Name'),
        trans('messages.Employer Contribution'),
        trans('messages.Employee Contribution'),
        trans('messages.Date of Contribution')
        );

    $sum_employer_contribution = 0;
    $sum_employee_contribution = 0;
    
    foreach($slips as $slip){
      $col_data[] = array(
          $slip->month.' '.$slip->year,
          $slip->User->first_name.' '.$slip->User->last_name.' 
          ('.$slip->User->Location->location.' in '.$slip->User->Location->Client->client_name.')',
          round($slip->employer_contribution,2),
          round($slip->employee_contribution,2),
          Helper::showDate($slip->date_of_contribution)
          );

          $sum_employer_contribution += $slip->employer_contribution;
          $sum_employee_contribution += $slip->employee_contribution;
    }

    $col_foots = array('-','-',round($sum_employer_contribution,2),round($sum_employee_contribution,2),'');

    Helper::writeResult($col_data);   

    return view('payroll.all_contribution',compact('users','user_id','month','year','col_heads','col_foots'));
  }

	public function destroy(){
	}
}
?>