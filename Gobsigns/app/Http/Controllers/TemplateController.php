<?php
namespace App\Http\Controllers;
use Entrust;
use Config;
use Activity;
use Auth;
use File;
use Mail;
use App\Classes\Helper;
use Illuminate\Http\Request;

Class TemplateController extends Controller{

	public function index(){
		$templates = Helper::getTemplate();

		foreach($templates as $template){
			$key = $template[0];
			$filename = base_path().'/config/template/'.$key;
			$content = File::get($filename);
			$template_content[$key] = $content;
		}
		return view('template.index',compact('templates','template_content'));
	}
	
	public function update(Request $request, $id){

		if(!Entrust::can('manage_template'))
			return redirect('/dashboard')->withErrors(config('constants.NA'));

		$templates = Helper::getTemplate();
		$templates[$id][2] = $request->input('template_subject');
		$key = $templates[$id][0];
		$filename = base_path().'/config/template/'.$key;
		File::put($filename,$request->input('template_description'));

		$filename = base_path().'/config/template.php';
		File::put($filename,var_export($templates, true));
		File::prepend($filename,'<?php return ');
		File::append($filename, ';');

		$activity = 'Template updated';
		Activity::log($activity);
		return redirect('/template')->withSuccess(config('constants.UPDATED'));
	}

	public function welcomeEmail($user_id,$token){

    if(!Entrust::can('send_template'))
      return redirect('/dashboard')->withErrors(config('constants.NA'));

    if(!Helper::verifyCsrf($token))
      return redirect('/dashboard')->withErrors(config('constants.CSRF'));

    $user = \App\User::find($user_id);

	$filename = base_path().'/config/template/send_welcome_email';
    $content = File::get($filename);

    if(!$user)
      return redirect()->back()->withErrors(config('constants.INVALID_LINK'));
    
    $mail_content = str_replace('[NAME]',$user->first_name." ".$user->last_name,$content);

      Mail::send('template.mail', compact('mail_content'), function($message) use ($user){
        $message->to($user->email, 'WM Lab')->subject('Welcome');
    });

    return redirect()->back()->withSuccess('Mail send successfully. ');
  }
}
?>