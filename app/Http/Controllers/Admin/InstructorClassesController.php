<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Classs;
use App\Models\Category;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Cycle;
use App\Models\Inscription;
use App\Models\Assist;
use App\Models\Attendance;
use App\Models\Config;
use Auth;
use DB;


class InstructorClassesController extends Controller
{
    public function index()
    {
        $config = Config::first();

        $myClasses = Classs::join('cycles', 'cycles.id', 'class.cycle_id')
        ->join('categories', 'categories.id', 'class.category_id')
        ->join('groups', 'groups.id', 'categories.group_id')
        ->join('schedule', 'schedule.id', 'class.schedule_id')
        ->join('facilities', 'facilities.id', 'schedule.facility_id')
        ->join('users', 'users.id', 'class.instructor_id')
        ->where('class.instructor_id',Auth::user()->id)
        ->where('class.status',1)
        ->orderBy('cycles.name','desc')
        ->orderBy(DB::raw('HOUR(schedule.start_time)'))
        ->get('class.*','cycles.*','categories.*','groups.*','schedule.*','facilities.*','users.*');

        return view('admin.myclasses.index', compact('myClasses','config'));
    }

    public function showclass($id)
    {
        $class = Classs::find($id);
        $cycle = Cycle::find($class->cycle_id);

        $inscritos = Inscription::join('class', 'class.id', '=', 'inscriptions.class_id')
        ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
        ->where('inscriptions.class_id',$id)
        ->where('inscriptions.status',1)
        ->where('inscriptions.inscription_status','1')
        ->orderBy('atleta.name','asc')
        ->get('inscriptions.*','class.*');

        $assists = Assist::where('class_id',$class->id)
        ->where('status',1)
        ->get();

        $config = Config::first();
        return view('admin.myclasses.show', compact('cycle','class','config','inscritos','assists'));
    }
}
