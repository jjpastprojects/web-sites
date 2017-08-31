<?php

namespace App\Http\Controllers;
use Spatie\Activitylog\Models\Activity;
use DB;
use Auth;
use Entrust;
use App\Clock;
use App\User;
use App\Client;
use App\Location;
use App\Task;
use App\Holiday;
use App\Todo;
use App\Classes\Helper;

class DashboardController extends Controller
{

   public function index(){

        $clock = Clock::where('user_id','=',Auth::user()->id)
            ->where('date','=',date('Y-m-d'))
            ->first();
        $user_count = User::count();
        $dept_count = Client::count();
        $task_count = Task::where('task_progress','<',100)->count();
        $present_count = Clock::where('date','=',date('Y-m-d'))->count();
        $employee = User::find(Auth::user()->id);

        for($i=6;$i>=0;$i--){
            $day = date('Y-m-d', strtotime('-'.$i.' days'));
            $present = Clock::where('date','=',$day)->count();
            $absent = $user_count-$present;
            $dayw = date('d M Y',strtotime($day));
            $graph_data[] = "{ y:'$day',a:$present,b:$absent}";
        }
        $graph_data = implode(',',$graph_data);

        if(Entrust::hasRole('admin'))
        $tasks = Task::where('task_progress','<',100)->get();
        else
        $tasks = Task::where('task_progress','<',100)->whereHas('user', function($q){
                $q->where('user_id','=',Auth::user()->id);
            })->get();


        if(!$clock)
            $clock_status = 'NA';
        elseif($clock->clock_out == null)
            $clock_status = 'IN';
        else
            $clock_status = 'OUT';

        $notices = \App\Notice::with('location')->where('from_date','<=',date('Y-m-d'))
                ->where('to_date','>=',date('Y-m-d'))->whereHas('location',function($query) {
                    $query->where('location_id','=',Auth::user()->location_id);
                })->get();

        $users = User::join('locations','locations.id','=','users.location_id')
            ->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name," ",last_name," ",location," (",client_name,")") AS name,username'))
            ->lists('name','username');
        
        $query = DB::table('activity_log')
            ->join('users','users.id','=','activity_log.user_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name) AS employee_name,activity_log.created_at AS created_at,text,user_id'));


        $child_location = Helper::childLocation(Auth::user()->location_id,1);
        $child_staff_count = User::whereIn('location_id',$child_location)->count();

        $child_users = User::whereIn('location_id',$child_location)->lists('id')->all();
        array_push($child_users,Auth::user()->id);

        if(!Entrust::hasRole('admin'))
            $query->whereIn('user_id',$child_users);

        $activities = $query->latest()->limit(100)->get();

        $compose_users = DB::table('users')
            ->where('users.id','!=',Auth::user()->id)
            ->join('locations','locations.id','=','users.location_id')
            ->join('clients','clients.id','=','locations.client_id')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS full_name,users.id AS user_id'))
            ->lists('full_name','user_id');

        $birthdays = DB::table('profile')
            ->join('users','users.id','=','profile.user_id')
            ->join('locations','locations.id','=','users.location_id')
            ->join('clients','clients.id','=','locations.client_id')
            ->where('date_of_birth','!=','null')
            ->select(DB::raw('CONCAT(first_name, " ", last_name, " (", location, " in ", client_name, " Client)") AS name,users.id AS user_id,profile.date_of_birth'))
            ->orderBy('date_of_birth','asc')
            ->get();

        $holidays = Holiday::all();
        $todos = Todo::where('user_id','=',Auth::user()->id)
            ->orWhere(function ($query)  {
                $query->where('user_id','!=',Auth::user()->id)
                    ->where('visibility','=','public');
            })->get();

        $events = array();
        foreach($birthdays as $birthday){
            $start = date('Y').'-'.date('m-d',strtotime($birthday->date_of_birth));
            $title = 'Birthday: '.$birthday->name;
            $color = '#133edb';
            $events[] = array('title' => $title, 'start' => $start, 'color' => $color);
        }
        foreach($holidays as $holiday){
            $start = $holiday->date;
            $title = 'Holiday: '.$holiday->holiday_description;
            $color = '#1e5400';
            $events[] = array('title' => $title, 'start' => $start, 'color' => $color);
        }
        foreach($todos as $todo){
            $start = $todo->date;
            $title = 'To do: '.$todo->todo_title.' '.$todo->todo_description;
            $color = '#ff0000';
            $url = '/todo/'.$todo->id.'/edit';
            $events[] = array('title' => $title, 'start' => $start, 'color' => $color, 'url' => $url);
        }

        $tree = array();
        $locations = Location::all();
        foreach ($locations as $location){
            $tree[$location->id] = array(
                'parent_id' => $location->top_location_id,
                'name' => $location->location.' ('.$location->Client->client_name.')'
            );
        }

        $assets = ['graph','calendar'];

        return view('dashboard',compact(
            'assets','clock_status','user_count','dept_count','task_count','present_count',
            'activities','employee','compose_users','graph_data','tasks','notices',
            'birthdays','holidays','users','events','tree','child_staff_count'
            ));
   }
}