<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Classs;
use App\Http\Requests\ClassFormRequest;
use App\Models\Category;
use App\Http\Requests\CategoryFormRequest;
use App\Models\Schedule;
use App\Http\Requests\ScheduleFormRequest;
use App\Models\User;
use App\Http\Requests\InstructorFormRequest;
use App\Models\Cycle;
use App\Models\Inscription;
use App\Models\Assist;
use App\Models\Attendance;
use App\Http\Requests\CycleFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Config;
use DB;
use Carbon\Carbon;

class ClassController extends Controller
{
    public function indexcycles(Request $request)
    {
        if ($request)
        {
            $queryCycle=$request->input('fcycle');
            $cycles=DB::table('cycles')
            ->where('status','=',1)
            ->where('name','LIKE','%'.$queryCycle.'%')
            ->orderBy('end_date','desc')
            ->get();
            $filterCycles = Cycle::all();
            return view('admin.class.indexcycles', compact('cycles','queryCycle','filterCycles'));
        }
    }

    public function indexclasses($id)
    {
        $cycle = Cycle::find($id);
        $config = Config::first();
        $classes=DB::table('class as cl')
        ->join('categories as cat','cl.category_id','=','cat.id')
        ->join('groups as g','cat.group_id','=','g.id')
        ->join('schedule as s','cl.schedule_id','=','s.id')
        ->join('facilities as f','s.facility_id','=','f.id')
        ->join('users as i','cl.instructor_id','=','i.id')
        ->select('cl.id','cl.cycle_id as CLcycle_id','cl.category_id as CLcategory_id','cl.schedule_id as CLschedule_id','cl.instructor_id as CLinstructor_id','cl.start_date as CLstart_date','cl.end_date as CLend_date','g.name as Gname','g.description as Gdescription','g.image as Gimage','g.status as Gstatus','cat.name as Cname','cat.age_from','cat.age_to','cat.description as Cdescripcion','cat.image as Cimage','cat.status as Cstatus','s.facility_id','s.start_time as Sstart_time','s.end_time as Send_time','s.sunday','s.monday','s.tuesday','s.wednesday','s.thursday','s.friday','s.saturday','s.quota','f.name as Fname','f.description as Fdescription','f.location','f.image as Fimage','f.status as Fstatus','i.name as Iname','i.email','i.phone','i.whatsapp')
        ->where('cl.cycle_id',$cycle->id)
        ->where('cl.status',1)
        ->orderBy('f.name','asc')
        ->orderBy(DB::raw('HOUR(s.start_time)'))
        ->get();

        return view('admin.class.indexclasses', compact('cycle','classes','config'));
    }

    public function addclass($id)
    {
        $cycle = Cycle::find($id);
        $categories=DB::table('categories')
        ->where('status',1)
        ->orderBy('group_id','asc')
        ->orderBy('name','asc')
        ->get();
        $schedules=DB::table('schedule')
        ->where('status',1)
        ->where('cycle_id',$id)
        ->orderBy('start_time','asc')
        ->get();
        $instructors=DB::table('users')
        ->where('status',1)
        ->where('role_as',3)
        ->orderBy('name','asc')
        ->get();
        $config = Config::first();
        return view('admin.class.addclass', compact('cycle','categories','schedules','instructors','config'));# code...
    }

    public function insertclass(ClassFormRequest $request)
    {
        $start_date = $request->get('start_date');
        $start_date = date("Y-m-d", strtotime($start_date));

        $end_date = $request->get('end_date');
        $end_date = date("Y-m-d", strtotime($end_date));

        $class = new Classs();
        $class->cycle_id = $request->input('cycle_id');
        $class->category_id = $request->input('category_id');
        $class->schedule_id = $request->input('schedule_id');
        $class->instructor_id = $request->input('instructor_id');
        $class->notes = $request->input('notes');
        $class->inscription_payment = $request->input('inscription_payment');
        $class->monthly_payment = $request->input('monthly_payment');
        $class->badge = $request->input('badge');
        $class->start_date = $start_date;
        $class->end_date = $end_date;
        $class->status = 1;
        $class->save();

        return redirect('index_classes/'.$class->cycle_id)->with('status',__('Class Added Successfully'));
    }

    public function editclass($id)
    {
        $class = Classs::find($id);
        $cycle = Cycle::find($class->cycle_id);
        $categories=DB::table('categories')
        ->where('status',1)
        ->orderBy('group_id','asc')
        ->orderBy('name','asc')
        ->get();
        $schedules=DB::table('schedule')
        ->where('status',1)
        ->where('cycle_id',$id)
        ->orderBy('start_time','asc')
        ->get();
        $instructors=DB::table('users')
        ->where('status',1)
        ->where('role_as',3)
        ->orderBy('name','asc')
        ->get();
        $config = Config::first();
        return view('admin.class.editclass', compact('class','cycle','categories','schedules','instructors','config'));
    }

    public function updateclass(ClassFormRequest $request, $id)
    {
        $start_date = $request->get('start_date');
        $start_date = date("Y-m-d", strtotime($start_date));

        $end_date = $request->get('end_date');
        $end_date = date("Y-m-d", strtotime($end_date));

        $class = Classs::find($id);
        $class->category_id = $request->input('category_id');
        $class->schedule_id = $request->input('schedule_id');
        $class->instructor_id = $request->input('instructor_id');
        $class->notes = $request->input('notes');
        $class->inscription_payment = $request->input('inscription_payment');
        $class->monthly_payment = $request->input('monthly_payment');
        $class->badge = $request->input('badge');
        $class->start_date = $start_date;
        $class->end_date = $end_date;
        $class->update();

        return redirect('index_classes/'.$class->cycle_id)->with('status',__('Class Updated Successfully'));
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
        return view('admin.class.showclass', compact('cycle','class','config','inscritos','assists'));
    }

    public function destroyclass($id)
    {
        $class = Classs::find($id);
        $class->status = 0;
        $class->update();
        return redirect('index_classes/'.$class->cycle_id)->with('status',__('Class Deleted Successfully'));
    }

    //Assists functions
    public function addassist($id)
    {
        $class = Classs::find($id);
        $cycle = Cycle::find($class->cycle_id);
        $category = Category::find($class->category_id);
        $schedule = Schedule::find($class->schedule_id);
        $instructor = User::find($class->instructor_id);

        $inscritos = Inscription::join('class', 'class.id', '=', 'inscriptions.class_id')
        ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
        ->where('inscriptions.class_id',$id)
        ->where('inscriptions.status',1)
        ->where('inscriptions.inscription_status','1')
        ->orderBy('atleta.name','asc')
        ->get('inscriptions.*','class.*');

        $config = Config::first();
        return view('admin.class.addassist', compact('class','cycle','category','schedule','instructor','inscritos','config'));
    }

    public function insertassist(Request $request)
    {
        $class_id = $request->input('class_id');

        $assist = new Assist();
        $assist->class_id = $class_id;
        $assist->notes = $request->input('notes');
        $assist->status = 1;
        $assist->save();

        $inscritos = Inscription::join('class', 'class.id', '=', 'inscriptions.class_id')
        ->join('atleta', 'atleta.id', '=', 'inscriptions.atleta_id')
        ->where('inscriptions.class_id',$class_id)
        ->where('inscriptions.status',1)
        ->where('inscriptions.inscription_status','1')
        ->orderBy('atleta.name','asc')
        ->get('inscriptions.*','class.*');

        foreach($inscritos as $inscrito)
        {
            $attendance = new Attendance();
            $attendance->assist_id=$assist->id;
            $attendance->atleta_id=$request->get('atleta_id_'.$inscrito->id);
            $attendance->status=$request->input('status_'.$inscrito->id) == TRUE ? '1':'0';
            $attendance->save();
        }

        if (Auth::user()->role_as != 3) {
            return redirect('show-class/'.$class_id)->with('status',__('Attendance Added Successfully'));
        } else {
            return redirect('my-classes/'.$class_id)->with('status',__('Attendance Added Successfully'));
        }


    }

    public function editassist($id)
    {
        $assist = Assist::find($id);
        $class = Classs::find($assist->class_id);
        $cycle = Cycle::find($class->cycle_id);
        $category = Category::find($class->category_id);
        $schedule = Schedule::find($class->schedule_id);
        $instructor = User::find($class->instructor_id);

        $attendances = Attendance::join('assists', 'assists.id', '=', 'attendances.assist_id')
        ->join('class', 'class.id', '=', 'assists.class_id')
        ->join('atleta', 'atleta.id', '=', 'attendances.atleta_id')
        ->where('attendances.assist_id',$assist->id)
        ->orderBy('atleta.name','asc')
        ->get('attendances.*','assists.*','class.*','atleta.*');

        $config = Config::first();

        return view('admin.class.editassist', compact('assist','class','cycle','category','schedule','instructor','attendances','config'));
    }

    public function updateassist(Request $request, $id)
    {
        $assist = Assist::find($id);
        $assist->notes = $request->input('notes');
        $assist->update();

        $attendances = Attendance::join('assists', 'assists.id', '=', 'attendances.assist_id')
        ->join('class', 'class.id', '=', 'assists.class_id')
        ->join('atleta', 'atleta.id', '=', 'attendances.atleta_id')
        ->where('attendances.assist_id',$assist->id)
        ->orderBy('atleta.name','asc')
        ->get('attendances.*','assists.*','class.*','atleta.*');

        foreach($attendances as $att)
        {
            $attendance = Attendance::find($att->id);
            $attendance->status=$request->input('status_'.$att->id) == TRUE ? '1':'0';
            $attendance->save();
        }

        if (Auth::user()->role_as != 3) {
            return redirect('show-class/'.$assist->class_id)->with('status',__('Attendance Updated Successfully'));
        } else {
            return redirect('my-classes/'.$assist->class_id)->with('status',__('Attendance Updated Successfully'));
        }
    }

    public function showassist($id)
    {
        $assist = Assist::find($id);
        $class = Classs::find($assist->class_id);
        $cycle = Cycle::find($class->cycle_id);
        $category = Category::find($class->category_id);
        $schedule = Schedule::find($class->schedule_id);
        $instructor = User::find($class->instructor_id);

        $attendances = Attendance::join('assists', 'assists.id', '=', 'attendances.assist_id')
        ->join('class', 'class.id', '=', 'assists.class_id')
        ->join('categories', 'categories.id', '=', 'class.category_id')
        ->join('cycles', 'cycles.id', '=', 'class.cycle_id')
        ->join('users', 'users.id', '=', 'class.instructor_id')
        ->join('schedule', 'schedule.id', '=', 'class.schedule_id')
        ->join('atleta', 'atleta.id', '=', 'attendances.atleta_id')
        ->where('attendances.assist_id',$assist->id)
        ->orderBy('atleta.name','asc')
        ->get('attendances.*','assists.*','class.*','atleta.*','categories.*','cycles.*','users.*','schedule.*');

        $config = Config::first();

        return view('admin.class.showassist', compact('assist','class','cycle','category','schedule','instructor','attendances','config'));
    }

    public function destroyassist($id)
    {
        $attendances = Attendance::where('assist_id',$id)->delete();
        $assist = Assist::find($id);
        $classid = $assist->class_id;
        $assist->delete();

        if (Auth::user()->role_as != 3) {
            return redirect('show-class/'.$classid)->with('status',__('Attendance Deleted Successfully'));
        } else {
            return redirect('my-classes/'.$classid)->with('status',__('Attendance Deleted Successfully'));
        }
    }
}
