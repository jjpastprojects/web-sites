<?php
namespace App\Http\Middleware;
use Closure;
use File;
use Config;
use Auth;
use Session;
use App;
use DB;
use App\Message;
use App\Leave;

class WMLabMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!File::exists(base_path().'/config/config.php'))
            abort(399,'config/config.php file not found !!');
        if (!File::exists(base_path().'/config/constants.php'))
            abort(399,'config/constants.php file not found !!');
        if (!File::exists(base_path().'/config/paths.php'))
            abort(399,'config/paths.php file not found !!');
        if (!File::exists(base_path().config('paths.LANG_PATH')))
            abort(399,'config/lang.php file not found !!');
        if (!File::exists(base_path().config('paths.LANGUAGE_PATH')))
            abort(399,'config/language.php file not found !!');
        if (!File::exists(base_path().config('paths.TIMEZONE_PATH')))
            abort(399,'config/timezone.php file not found !!');
        if (!File::exists(base_path().config('paths.COUNTRY_PATH')))
            abort(399,'config/country.php file not found !!');
        if (!File::exists(base_path().config('paths.MAIL_PATH')))
            abort(399,'config/mail.php file not found !!');
        if (!File::exists(base_path().config('paths.SMS_PATH')))
            abort(399,'config/twilio.php file not found !!');
        if (!File::exists(base_path().config('paths.TEMPLATE_PATH')))
            abort(399,'config/template.php file not found !!');
        if (!File::exists(base_path().config('paths.SMS_TEMPLATE_PATH')))
            abort(399,'config/sms_template.php file not found !!');

        $languages = File::getRequire(base_path().config('paths.LANG_PATH'));
        $timezones = File::getRequire(base_path().config('paths.TIMEZONE_PATH'));
        $countries = File::getRequire(base_path().config('paths.COUNTRY_PATH'));
        Config::set('app.debug',config('config.error_display'));
    
        $token = csrf_token();
        $custom_field_values = array();
        $page_title = '';
        $share = [
            'token' => $token, 
            'timezones' => $timezones,
            'countries' => $countries,
            'languages' => $languages,
            'custom_field_values' => $custom_field_values,
            'page_title' => $page_title
            ];
        view()->share($share);
        
        $direction = '';
            $default_timezone = config('config.timezone_id') ? $timezones[config('config.timezone_id')] : $timezones['266'];
                date_default_timezone_set($default_timezone);
        if (Auth::check())
        {

            $default_language = (config('config.default_language') != '') ? config('config.default_language') : 'en' ;

            $header_inbox_count = Message::where('to_user_id','=',Auth::user()->id)
                ->where('read','=',0)
                ->count();

            $header_inbox = Message::where('to_user_id','=',Auth::user()->id)
                ->join('users','users.id','=','messages.from_user_id')
                ->where('read','=',0)
                ->select(DB::raw('CONCAT(first_name, " ", last_name) AS name,users.id as user_id,messages.created_at as time,messages.id,messages.subject'))
                ->take(5)
                ->get();

            $header_leave_count = Leave::where('leave_status','=','pending')
                ->count();

            $header_leave = Leave::where('leave_status','=','pending')
                ->take(5)
                ->get();

            $data = [
                'default_timezone' => $default_timezone,
                'header_inbox' => $header_inbox,
                'header_inbox_count' => $header_inbox_count,
                'header_leave' => $header_leave,
                'header_leave_count' => $header_leave_count,
                'default_language' => $default_language
                ];
            $language = Session::get('language',$default_language);
            App::setLocale($language);

            view()->share($data);
            $direction = config('config.direction');
        }
        view()->share('direction',$direction);
        $assets = array();
        view()->share('assets',$assets);

        $response = $next($request);

        return $response;
    }
}
