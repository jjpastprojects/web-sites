<?php
namespace App\Http\Controllers;
use DB;
use File;
use Config;
use Entrust;
use App\Classes\Helper;
use Illuminate\Http\Request;
use App\Http\Requests\ConfigurationTimeRequest;
use App\AwardType;
use App\LeaveType;
use App\SalaryType;
use App\DocumentType;
use App\ExpenseHead;
use App\Role;
use Validator;

Class ConfigController extends Controller{

	public function index(){
        $award_types = AwardType::all();
        $leave_types = LeaveType::all();
        $document_types = DocumentType::all();
        $salary_types = SalaryType::all();
        $expense_heads = ExpenseHead::all();
        $languages = Helper::getAllLanguages();
		$config = Helper::getConfiguration();
		$mail_config = Helper::getMail();
		$sms_config = Helper::getSMS();
		$services = Helper::getServices();
        $assets = ['datetimepicker','mail_config'];

        $roles = DB::table('roles')->get();
        $permissions = DB::table('permissions')->orderBy('category')->get();
        
        $permission_role = DB::table('permission_role')
        	->select(DB::raw('CONCAT(role_id,"-",permission_id) AS detail,id'))
        	->lists('detail','id');
        $data = [
        	'award_types' => $award_types,
        	'leave_types' => $leave_types,
        	'document_types' => $document_types,
        	'salary_types' => $salary_types,
        	'expense_heads' => $expense_heads,
        	'languages' => $languages,
        	'config' => $config,
        	'mail_config' => $mail_config,
        	'sms_config' => $sms_config,
        	'services' => $services,
        	'roles' => $roles,
        	'permissions' => $permissions,
        	'permission_role' => $permission_role,
        	'assets' => $assets,
        	'category' => null
        	];

		return view('configuration.index',$data);
	}

	public function mailStore(Request $request){
		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		$validation = Validator::make($request->all(),[
				'from_address' => 'required|email',
				'from_name' => 'required'
				]);

		if($validation->fails()){
			return redirect()->back()->withInput()->withErrors($validation->messages());
		}
		
		$mail_config = Helper::getMail();
		$services = Helper::getServices();

		$config_type = $request->input('config_type');

		$mail_config['driver'] = $request->input('driver');
		$mail_config['from']['address'] = $request->input('from_address');
		$mail_config['from']['name'] = $request->input('from_name');

		if($request->input('driver') == 'smtp'){	
			$mail_config['host'] = $request->input('host');
			$mail_config['port'] = $request->input('port');
			$mail_config['username'] = $request->input('username');
			$mail_config['password'] = $request->input('password');
		}
		elseif($request->input('driver') == 'mandrill'){
			$services['mandrill']['secret'] = $request->input('mandrill_secret');
			$filename = base_path().'/config/services.php';
			File::put($filename,var_export($services, true));
			File::prepend($filename,'<?php return ');
			File::append($filename, ';');
		}
		elseif($request->input('driver') == 'mailgun'){
			$services['mailgun']['secret'] = $request->input('mailgun_secret');
			$services['mailgun']['domain'] = $request->input('mailgun_domain');
			$filename = base_path().'/config/services.php';
			File::put($filename,var_export($services, true));
			File::prepend($filename,'<?php return ');
			File::append($filename, ';');
		}
		$mail_config['encryption'] = 'tls';
		$mail_config['sendmail'] = '/usr/sbin/sendmail -bs';
		$mail_config['pretend'] = false;

		$filename = base_path().'/config/mail.php';
		File::put($filename,var_export($mail_config, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		return redirect('/configuration#'.$config_type)->withSuccess(config('constants.SAVED'));			

	}

	public function smsStore(Request $request){
		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		$sms_config = Helper::getSMS();

		$config_type = $request->input('config_type');

		$sms_config['sid'] = $request->input('sid');
		$sms_config['token'] = $request->input('token');
		$sms_config['from'] = $request->input('from');

		$filename = base_path().'/config/twilio.php';
		File::put($filename,var_export($sms_config, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		return redirect('/configuration#'.$config_type)->withSuccess(config('constants.SAVED'));			

	}

	public function jobStore(Request $request){
		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		$config = Helper::getConfiguration();
		$config['job_application_staff'] = $request->input('job_application_staff');
		$config['application_format'] = $request->input('application_format');

		$filename = base_path().'/config/config.php';
		File::put($filename,var_export($config, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		return redirect('/configuration#'.$request->input('config_type'))->withSuccess(config('constants.SAVED'));			
	}

	public function savePermission(Request $request){

		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		$input = $request->all();
		$permissions = array_get($input, 'permission');

		if(!Entrust::hasRole('admin'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		DB::table('permission_role')->truncate();

		if($permissions != '')
		foreach($permissions as $r_key => $permission){
			foreach($permission as $p_key => $per){
				$values[] = $p_key;
			}
			$role = Role::find($r_key);
			if(count($values))
			$role->attachPermissions($values);
			unset($values);
		}

		return redirect('/configuration#permission')->withSuccess(config('constants.UPDATED'));
	}

	public function officeTime(ConfigurationTimeRequest $request){

		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));

		$in_time = strtotime(date('Y-m-d')." ".$request->input('in_time'));
		$out_time = strtotime(date('Y-m-d')." ".$request->input('out_time'));
		$config = Helper::getConfiguration();
		$config['in_time'] = date('H:i',$in_time);
		$config['out_time'] = date('H:i',$out_time);

		$filename = base_path().'/config/config.php';
		File::put($filename,var_export($config, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		return redirect('/configuration#'.$request->input('config_type'))->withSuccess(config('constants.SAVED'));			
	}

	public function store(Request $request){
		if(!Helper::getMode())
			return redirect()->back()->withErrors(config('constants.DISABLE_MESSAGE'));
		
		$config = Helper::getConfiguration();

		$config_type = $request->input('config_type');
		$input = $request->all();
		foreach($input as $key => $value){
			if($key != '_token' && $key != 'config_type')
			$config[$key] = $value;
		}

		$filename = base_path().'/config/config.php';
		File::put($filename,var_export($config, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		return redirect('/configuration#'.$config_type)->withSuccess(config('constants.SAVED'));			
	}
}
?>